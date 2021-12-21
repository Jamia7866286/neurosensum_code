import { Component, OnInit, Input, OnDestroy, HostListener } from '@angular/core';
import { EChartOption } from 'echarts';
import { ProjectService } from '../../../services/project/project.service';
import { ConfigService } from '../../../services/config/config.service';
import { FilterService } from '../../../services/filter/filter.service';
import { CrosstabTypes, MonitorResponse, CrosstabDefination } from '../../../models/model';
import { DpuService } from '../../../services/dpu/dpu.service';
import { HttpClient } from '@angular/common/http';
import { Word } from 'd3-cloud';
import { max, min, scaleLinear, scaleOrdinal, select } from 'd3';
import * as cloud_ from 'd3-cloud';

const cloud = cloud_;
import { CHART_COLOR_PALETTE } from '../../../constants/constants';

@Component({
  selector: 'dashboard-d3-word-cloud',
  templateUrl: './d3-word-cloud.component.html',
  styleUrls: ['./d3-word-cloud.component.scss']
})
export class D3WordCloudComponent implements OnInit, OnDestroy {
  pageIndex = 0;
  @Input() pageSize = 500;
  @Input() wordCount = 100;
  isLoading = true;
  componentBinded = false;
  excludedFilters: string[];
  monitorResponseData: string[] = [];
  // @Input() widget: Widget;

  @Input() textVariableId: string;
  @Input() minWordFrequency = 1;
  @Input() excludeFilters: Array<string>;

  @Input() fontSizeRange: Array<number> = [10, 50];

  public options: EChartOption = {};

  filterBindedSubscriber: any;
  filterChangedSubscriber: any;

  constructor(
    private projectService: ProjectService,
    private configService: ConfigService,
    private filterService: FilterService,
    private dpuService: DpuService,
    private http: HttpClient) { }

  ngOnDestroy(): void {
    this.filterBindedSubscriber.unsubscribe();
    this.filterChangedSubscriber.unsubscribe();
  }

  @HostListener('window:resize')
  onResize() {
    this.redraw();
  }

  ngOnInit() {

    this.filterBindedSubscriber = this.filterService.filtersBinded$.subscribe((value: boolean) => {
      if (value === true) {
        this.bindChart();
        this.componentBinded = true;
      }
    });

    this.filterChangedSubscriber = this.filterService.filterChanged$.subscribe((variableId: string) => {
      if (variableId) {
        if (this.excludeFilters) {
          if (this.excludeFilters.indexOf(variableId) === -1) {
            this.bindChart();
          }
        } else {
          this.bindChart();
        }
      }
    });
  }


  redraw() {
    this.getWordsForCloud().then(cloudWords => {
      this.renderWordCloud(cloudWords);
    });
  }

  bindChart() {
    this.options = {};
    this.isLoading = true;
    const tableDefination = new CrosstabDefination(
      this.configService.projectGuid, // projectGuid
      this.configService.subscriptionGuid, this.projectService.project.publishVersion,
      this.configService.projectGuid, undefined, // subscriptionGuid
      CrosstabTypes.ResponseData);
    tableDefination.variables = [this.textVariableId];
    tableDefination.dynamicFilter = this.filterService.GetAppliedFilters(this.excludeFilters);
    this.dpuService.GetResponses(tableDefination, this.pageSize, this.pageIndex)
      .subscribe((monitorResponse: MonitorResponse) => {
        this.monitorResponseData = monitorResponse.data.map(data => data[0]) as Array<string>;
        this.redraw();
        this.isLoading = false;
      });
  }

  GetStopWords() {
    return this.http.get('assets/data/stop_words.json');
  }

  private getWordsForCloud(): Promise<Word[]> {
    return new Promise((resolve, reject) => {
      this.GetStopWords().subscribe((stopWords: string[]) => {
        const wordCountMap: { [word: string]: { text: string, count: number } } = {};
        const monitorDataWithoutStopWords = this.removeStopWords(this.monitorResponseData, stopWords);
        const words = monitorDataWithoutStopWords.join(' ').split(/[ '\-\(\)\*":;\[\]|{},.!?]+/);

        for (const word of words) {
          if (word.toLowerCase() in wordCountMap) {
            wordCountMap[word.toLowerCase()].count++;
          } else {
            wordCountMap[word.toLowerCase()] = {
              text: word,
              count: 1
            };
          }
        }

        // sorting wordCloudMap
        const sortedWordData = Object.values(wordCountMap).map(word => [word.text, word.count]).sort((first, second) => {
          return (second[1] as number) - (first[1] as number);
        });
        // remove words less than min threshold
        const wordsToUse = sortedWordData.filter(x => x[1] > this.minWordFrequency);

        // take top 50 words and map them to Word object for cloud
        const wordsForCloud = wordsToUse.slice(0, this.wordCount)
          .map(word => this.getWordForCloud(word[0] as string, word[1] as number));

        resolve(wordsForCloud);
      }, error => {
        reject(error);
      });
    });


  }

  private getWordForCloud(text: string, strength: number) {
    const wordForCloud: Word = {
      text,
      size: strength
    };
    return wordForCloud;
  }
  // render the word cloud using the words passed
  private renderWordCloud(words: Array<Word>) {
    const renderingDiv = document.getElementById('word-cloud-canvas');
    const computedStyle = getComputedStyle(renderingDiv);
    const maxCountInWords = max(words.map(word => word.size));
    const minCountInWords = min(words.map(word => word.size));
    const renderWidth = renderingDiv.parentElement.clientWidth - parseFloat(computedStyle.paddingLeft)
      - parseFloat(computedStyle.paddingRight) - 10;
    const renderHeight = renderingDiv.parentElement.clientHeight - parseFloat(computedStyle.paddingTop)
      - parseFloat(computedStyle.paddingBottom) - 10;
    const fontScale = scaleLinear() // scale algo which is used to map the domain to the range
      .domain([minCountInWords, maxCountInWords]) // set domain which will be mapped to the range values
      .range(this.fontSizeRange);

    cloud().size([renderWidth, renderHeight])
      .words(words)
      .padding(1)
      .rotate(() => ~~(Math.random() * 2) * -90) // ~~(Math.random() * 2) * -90
      .font('-apple-system, BlinkMacSystemFont, Segoe UI, Roboto, Oxygen, Ubuntu, Fira Sans, Droid Sans, Helvetica Neue, sans-serif')
      .fontSize((d: Word) => fontScale(d.size))
      .fontWeight(900)
      .spiral('archimedean')
      .on('end', this.draw.bind(this))
      .start();


  }

  // Draw the word cloud
  private draw(words: Array<Word>) {
    const renderingDiv = document.getElementById('word-cloud-canvas');
    renderingDiv.innerHTML = null;
    const fill = scaleOrdinal(CHART_COLOR_PALETTE);
    const svg = select('#word-cloud-canvas').append('svg')
      .attr('width', '100%')
      .attr('height', '100%')
      .attr('viewBox', '0 0 ' + Math.min(renderingDiv.parentElement.clientWidth, renderingDiv.parentElement.clientHeight) +
        ' ' + Math.min(renderingDiv.parentElement.clientWidth, renderingDiv.parentElement.clientHeight))
      .attr('preserveAspectRatio', 'xMinYMin')
      .append('g')
      .attr('transform', `translate(${renderingDiv.parentElement.clientWidth / 2},${renderingDiv.parentElement.clientHeight / 2})`);


    const wordCloud = svg.selectAll('g text')
      .data(words);

    // Entering words
    wordCloud.enter()
      .append('text')
      // tslint:disable-next-line:max-line-length
      .style('font-family', '-apple-system, BlinkMacSystemFont, Segoe UI, Roboto, Oxygen, Ubuntu, Fira Sans, Droid Sans, Helvetica Neue, sans-serif')
      .style('fill', (d, i) => fill(i.toString()))
      .attr('text-anchor', 'middle')
      .attr('font-weight', 800)
      .attr('font-size', (d) => d.size)
      .attr('transform', (d) => {
        return 'translate(' + [d.x, d.y] + ')rotate(' + d.rotate + ')';
      })
      .text((d) => d.text);

    // Exiting words
    wordCloud.exit()
      .transition()
      .duration(200)
      .style('fill-opacity', 1e-6)
      .attr('font-size', 1)
      .remove();
  }

  private removeStopWords(sentences: Array<string>, stopWords: Array<string>): Array<string> {
    let groupedSentence = sentences.join('   ').toUpperCase();
    for (const stopWord of stopWords) {
      const regex = RegExp('\\b' + stopWord.trim() + '\\b', 'ig');
      groupedSentence = groupedSentence.replace(regex, '').replace(/[0-9]/g, '');
    }
    return groupedSentence.split('   ');
  }

}
