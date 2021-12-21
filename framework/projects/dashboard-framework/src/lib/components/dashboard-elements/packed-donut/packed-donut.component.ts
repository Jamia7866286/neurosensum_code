import { Component, OnInit, Input, ViewChild, ElementRef, SimpleChanges } from '@angular/core';
import { DpuService } from '../../../services/dpu/dpu.service';
import { CrosstabDefination, CrosstabTypes, HttpResponseTypes, TopicInsights, SentimentRange } from '../../../models/model';
import { Guid } from 'guid-typescript';
import { ConfigService } from '../../../services/config/config.service';
import { ProjectService } from '../../../services/project/project.service';
import { element } from 'protractor';
import { FilterService } from '../../../services/filter/filter.service';
// import { FilterService } from 'dashboard-framework/public-api';
declare var d3: any;
@Component({
  selector: 'dashboard-packed-donut',
  templateUrl: './packed-donut.component.html',
  styleUrls: ['./packed-donut.component.scss']
})
export class PackedDonutComponent implements OnInit {
  @ViewChild('chart') chartContainer: ElementRef;
  @Input() pageSize = 10;
  @Input() topicsPerPage = 10;
  @Input() variableId: string;
  @Input() excludeFilters: Array<string>;
  data: any;
  index = -1;
  maxIndex: number;
  filterBindedSubscriber: any;
  filterChangedSubscriber: any;
  // tableDef: CrosstabDefination;
  constructor(private dpuService: DpuService, private configService: ConfigService,
    private filterService: FilterService,
    private projectService: ProjectService) { }

  ngOnInit() {
    this.filterBindedSubscriber = this.filterService.filtersBinded$.subscribe((value: boolean) => {
      if (value === true) {
        this.bindChart();
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

  // tslint:disable-next-line: use-lifecycle-interface
  ngOnChanges(changes: SimpleChanges): void {
    // tslint:disable-next-line: max-line-length
    if ((changes.crosstabDefination && changes.crosstabDefination.currentValue) || (changes.dataSelector && changes.dataSelector.currentValue)) {
      this.bindChart();
    }
  }

  bindChart() {
    const crosstabDefination = new CrosstabDefination(
      this.configService.projectGuid, // projectGuid
      this.configService.subscriptionGuid, this.projectService.project.publishVersion, 
      this.configService.projectGuid, undefined, // subscriptionGuid
      CrosstabTypes.ResponseData );
      crosstabDefination.variables.push(this.variableId);
    crosstabDefination.dynamicFilter = this.filterService.GetAppliedFilters(this.excludeFilters);
    this.dpuService.GetTopicsSentimentForVariable(crosstabDefination, this.index, this.topicsPerPage,
      this.projectService.surveyConfiguration.language.defaultLanguage.languageInitials).then(
        (response: any) => {
          this.generateData(response);
          this.chartContainer.nativeElement.innerHTML = '';
          this.generateChart();
        }
      );
  }
  // tslint:disable-next-line: max-line-length

  generateData(response: any) {
    this.data = [];
    for (let i = 0; i < 10; i++) {
      if (!response.topics[i].sentiment[SentimentRange.Bad]) {
        response.topics[i].sentiment[SentimentRange.Bad] = 0;
      }
      if (!response.topics[i].sentiment[SentimentRange.Neutral]) {
        response.topics[i].sentiment[SentimentRange.Neutral] = 0;
      }
      if (!response.topics[i].sentiment[SentimentRange.Good]) {
        response.topics[i].sentiment[SentimentRange.Good] = 0;
      }
      this.data.push([response.topics[i].topic, [response.topics[i].sentiment[SentimentRange.Neutral],
      response.topics[i].sentiment[SentimentRange.Bad],
      response.topics[i].sentiment[SentimentRange.Good]], response.topics[i].totalCount])
    }

    const highestCount = this.data.reduce((accumulator, value, i) => {
      if (accumulator < value[2]) {
        this.maxIndex = i;
        return value[2];
      } else {
        return accumulator;
      }
    }, 0);

    const b = this.data[0];
    this.data[0] = this.data[this.maxIndex];
    this.data[this.maxIndex] = b;


  }
  generateChart() {
    const color = d3.scale.ordinal().range(['#f16e64', '#f9b73e', '#3cc273', 'black']);
    const element = this.chartContainer.nativeElement;
    const width = element.clientWidth || 400;
    const height = element.clientHeight || 400;
    // const width = 700;
    // const height = 700;

    const radius = Math.min(width, height) / 2;

    const pie = d3.layout.pie()
      .sort(null);

    const arc = d3.svg.arc()
      .innerRadius(radius)
      .outerRadius(radius);

    const bubble = d3.layout
      .pack()
      .value((d) => {
        return d[2];
      })
      .sort(null)
      .size([width, height])
      .padding(20);

    const svg = d3.select(element).append('svg')
      .attr('width', width)
      .attr('height', height)
      .append('g')
      .attr('class', 'bubble');

    const nodes = svg.selectAll('g.node').data(
      bubble.nodes({ children: this.data }).filter((d) => {
        return !d.children;
      })
    );

    nodes.enter().append('g').attr('class', 'node').attr('transform', (d) => {
      return 'translate(' + (d.x) + ',' + d.y + ')';
    });

    const arcGs = nodes.selectAll('g.arc').data((d) => {
      return pie(d[1]).map((m) => {
        m.r = d.r;
        return m;
      });
    });

    nodes.append('text')
      .attr('dy', '.35em')
      .style('text-anchor', 'middle')
      .style('font-smooth', 'always')
      .text((d) => {
        return d[0];
      })

      .style('font-size', (d) => { return (d.r / 55) + 'em'; })
      .call(this.wrap);

    nodes.style('cursor', 'pointer');

    const arcEnter = arcGs.enter().append('g').attr('class', 'arc');

    arcEnter
      .append('path')
      .attr('d', (d) => {
        arc.innerRadius(d.r + 8);
        arc.outerRadius(d.r);
        return arc(d);
      })
      .style('fill', (d, i) => {
        return color(i);
      });

  }

  wrap(a) {
    a.each((element, i) => {
      const text = d3.select(this[0][i]);
      const words = text.text().split(/\s+/).reverse();
      let word;
      let lineNumber;
      let line = [];
      if (words.length <= 2) {
        lineNumber = 0;
      }
      else {
        lineNumber = -1;
      }
      const lineHeight = element.r / 40;
      const y = text.attr('y');
      // const dy = parseFloat(text.attr('dy'));
      let tspan = text.text(null);
      // tslint:disable-next-line:no-conditional-assignment
      while (word = words.pop()) {
        line.push(word);
        tspan.text(line.join(' '));
        line.pop();
        tspan.text(line.join(' '));
        line = [word];
        tspan = text.append('tspan').attr('x', 0).attr('y', y).attr('dy', lineNumber * lineHeight + 'em').text(word);
        if (lineNumber <= 0) {
          lineNumber = 1;
        }
      }
    });
  }
}
