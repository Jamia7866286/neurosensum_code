import { Injectable } from '@angular/core';
import { CrosstabResult, DataSelector, KpiDataSelector, ChartTypes, CrosstabResultBreak, CrosstabMeasureTypes, TimelineResult, MonitorResponse } from '../../models/model';
import { EChartOption } from 'echarts';
import { CHART_COLOR_PALETTE, MEASURE_SEPERATOR } from '../../constants/constants';
import * as moment_ from 'moment-timezone';
const moment = moment_
@Injectable({
  providedIn: 'root'
})
export class DataTransformerService {

  constructor() { }

  GetChartConfig(crossTabResult: CrosstabResult, chartType: ChartTypes, customChartProperties: EChartOption,
    dataSelector?: DataSelector | KpiDataSelector): EChartOption {

    let chartOptions = new Object() as EChartOption;
    dataSelector = dataSelector ? dataSelector : new DataSelector();

    /* Setting default chart properties */
    this.setChartDefaultProperties(chartOptions);

    /* Fill chart data according to chart type */
    switch (chartType) {
      case ChartTypes.Scatter:
        this.setScatterChartConfigData(chartOptions, chartType, crossTabResult, dataSelector);
        break;
      case ChartTypes.SimpleArea:
      case ChartTypes.StackedArea:
      case ChartTypes.SimpleLine:
      case ChartTypes.SimplePie:
      case ChartTypes.SimpleDoughnut:
      case ChartTypes.StackedBar:
      case ChartTypes.SimpleBar:
      case ChartTypes.StackedColumn:
      case ChartTypes.SimpleColumn:
        this.setSimpleChartConfig(chartOptions, chartType, crossTabResult, dataSelector);
        break;
      case ChartTypes.Radar:
        this.setRadarChartConfig(chartOptions, chartType, crossTabResult, dataSelector)
        break;
      case ChartTypes.SimpleGauge:
        this.setGaugeChartConfig(chartOptions, chartType, crossTabResult, dataSelector);
        break;
      case ChartTypes.Timeline:
      case ChartTypes.TimelineChartRollback:
        this.setTimelineChartConfig(chartOptions, chartType, crossTabResult, dataSelector);
        break;
      default:
        break;
    }

    /* Adding custom chart properties */
    chartOptions = {
      ...chartOptions,
      ...customChartProperties
    }
    return chartOptions;
  }

  public GetChartConfigFromMonitorResponses(monitorResponse: MonitorResponse, chartType: ChartTypes, customChartProperties: EChartOption) {
    let chartOptions = new Object() as EChartOption;

    this.setChartDefaultProperties(chartOptions);

    switch (chartType) {
      case ChartTypes.WordCloud:
        this.setWordCloudChartData(chartOptions, chartType, monitorResponse)
        break;
    }
    /* Adding custom chart properties */
    chartOptions = {
      ...chartOptions,
      ...customChartProperties
    }
    return chartOptions;
  }

  /* Set default beautification  properties*/
  private setChartDefaultProperties(chartOptions: EChartOption) {
    chartOptions.grid = {
      containLabel: true,
      top: 18,
      bottom: 20,
      left: 10,
      right: 30
    };
    chartOptions.legend = {
      show: true,
      type: 'scroll',
      bottom: 0,
      align: 'right'
    };
    chartOptions.xAxis = {
      type: 'category',
      splitLine: {
        show: false,
        lineStyle: {
          type: 'solid'
        }
      }
    };
    chartOptions.yAxis = {
      type: 'value',
      splitLine: {
        show: true,
        lineStyle: {
          type: 'solid'
        }
      }
    };
    chartOptions.tooltip = {
      trigger: 'item',
      axisPointer: {
        type: 'cross'
      },
    };
    chartOptions.tooltip.axisPointer['label'] = {
      backgroundColor: '#6a7985'
    }
    chartOptions.color = CHART_COLOR_PALETTE;

    chartOptions.series = [];
  }

  private setWordCloudChartData(chartOptions: EChartOption, chartType: ChartTypes, monitorResponseData: MonitorResponse) {
    const textResponseIndex = 0;
    const strengthResponseIndex = 1;
    const wordCloudData = [];
    monitorResponseData.data.forEach((response) => {
      const word = {
        name: response[textResponseIndex],
        value: parseFloat(response[strengthResponseIndex]),
        textStyle: {
          normal: {
            color: CHART_COLOR_PALETTE[Math.floor(Math.random() * CHART_COLOR_PALETTE.length)]
          }
        }
      }
      wordCloudData.push(word);
    })
    chartOptions.series = [{
      ...this.getBasicSeriesConfig(chartType),
      data: wordCloudData
    }]
    this.addSpecificChartOptions(chartOptions, chartType);
  }

  /* returns chart options for bubble chart */
  private setScatterChartConfigData(chartOptions: EChartOption, chartType: ChartTypes, crossTabResult: CrosstabResult, dataSelector: DataSelector) {
    if (!dataSelector.rowAsCategories) {
      for (let rowIndex = 0; rowIndex < crossTabResult.rows.length; rowIndex++) {
        const row = crossTabResult.rows[rowIndex];

        /* skip if data row not selected in series of data selector and all selected data flag is also false*/
        if (!dataSelector.series.isAllSelected && !dataSelector.series.selectedData.includes(row.id)) {
          continue;
        }
        /* max value in current series */
        const seriesMaxVal = this.getMaxValueInSeries(row.id, rowIndex, crossTabResult.data);
        chartOptions.series = [...chartOptions.series, {
          ...(<any>this.getBasicSeriesConfig(chartType)),
          id: row.id,
          name: row.text,
          data: this.getSeriesData(chartType, rowIndex, row.id, crossTabResult.columns, crossTabResult.data, dataSelector),
          symbolSize: (data: Array<number>) => {
            return this.roundNumber(data[2] / seriesMaxVal * 100);
          }
        }]
      }
    } else {
      for (let columnIndex = 0; columnIndex < crossTabResult.columns.length; columnIndex++) {
        const column = crossTabResult.columns[columnIndex];

        if (!dataSelector.series.isAllSelected && !dataSelector.series.selectedData.includes(column.id)) {
          continue;
        }

        /* max value in current series */
        const seriesMaxVal = this.getMaxValueInSeries(column.id, columnIndex, crossTabResult.data);
        chartOptions.series = [...chartOptions.series, {
          ...(<any>this.getBasicSeriesConfig(chartType)),
          id: column.id,
          name: column.text,
          data: this.getSeriesData(chartType, columnIndex, column.id, crossTabResult.rows, crossTabResult.data, dataSelector),
          symbolSize: (data: Array<number>) => {
            return this.roundNumber(data[2] / seriesMaxVal * 100);
          }
        }]
      }
    }

    // setting chart options specific for bubble

    chartOptions.tooltip.formatter = (params: any) => {
      return this.roundNumber(params.value[2]).toString();
    }
  }

  private getMaxValueInSeries(seriesId: string, seriesIndex: number, crossTabResultData: Array<Array<number>>) {
    /* check if we have to find max value for row or a column */
    const isRow = seriesId.charAt(0) === 'R'
    let maxVal = 0;
    if (isRow) {
      for (const data of crossTabResultData[seriesIndex]) {
        if (data > maxVal) {
          maxVal = data;
        }
      }
    } else {
      for (const rowData of crossTabResultData) {
        if (rowData[seriesIndex] > maxVal) {
          maxVal = rowData[seriesIndex];
        }
      }
    }
    return maxVal;
  }

  private getSeriesData(chartType: ChartTypes, seriesIndex: number, seriesId: string, categoriesResultBreak: CrosstabResultBreak[],
    crosstabResultData: Array<Array<any>>, dataSelector: DataSelector): Array<any> {
    const isRowAsCategories = dataSelector && dataSelector.rowAsCategories ? true : false;
    if (chartType === ChartTypes.Scatter) {
      return categoriesResultBreak.reduce((seriesDataAccumulator, category, categoryIndex) => {
        /* Add data of column to series if data selected in data selector */
        if (!dataSelector.categories.isAllSelected) {
          if (dataSelector.categories.selectedData.includes(category.id)) {
            if (isRowAsCategories) {
              seriesDataAccumulator.push([categoryIndex, seriesIndex, crosstabResultData[categoryIndex][seriesIndex]]);
            } else {
              seriesDataAccumulator.push([categoryIndex, seriesIndex, crosstabResultData[seriesIndex][categoryIndex]]);
            }
          }
        } else {
          if (isRowAsCategories) {
            seriesDataAccumulator.push([categoryIndex, seriesIndex, crosstabResultData[categoryIndex][seriesIndex]]);
          } else {
            seriesDataAccumulator.push([categoryIndex, seriesIndex, crosstabResultData[seriesIndex][categoryIndex]]);
          }
        }

        /* return structure is [[xPt,yPt,Size],...] */
        return seriesDataAccumulator;
      }, [])
    } else if (chartType === ChartTypes.Radar) {
      return categoriesResultBreak.reduce((seriesDataAccumulator, category, categoryIndex) => {
        /* Add data of column to series if data selected in data selector */
        if (!dataSelector.categories.isAllSelected) {
          if (dataSelector.categories.selectedData.includes(category.id)) {
            if (isRowAsCategories) {
              seriesDataAccumulator.push(this.roundNumber(crosstabResultData[categoryIndex][seriesIndex]))
            } else {
              seriesDataAccumulator.push(this.roundNumber(crosstabResultData[seriesIndex][categoryIndex]))
            }
          }
        } else {
          if (isRowAsCategories) {
            seriesDataAccumulator.push(this.roundNumber(crosstabResultData[categoryIndex][seriesIndex]))
          } else {
            seriesDataAccumulator.push(this.roundNumber(crosstabResultData[seriesIndex][categoryIndex]))
          }
        }

        /* return structure is array of data of a series */
        return seriesDataAccumulator;
      }, [])
    } else if (chartType === ChartTypes.Timeline || chartType === ChartTypes.TimelineChartRollback) {
      return categoriesResultBreak.reduce((seriesDataAccumulator, category, categoryIndex) => {
        /* Add data of column to series if data selected in data selector */
        if (!dataSelector.categories.isAllSelected) {
          if (dataSelector.categories.selectedData.includes(category.id)) {
            this.setTimelineData(seriesDataAccumulator, crosstabResultData[seriesIndex][categoryIndex],
              parseInt(seriesId.split(MEASURE_SEPERATOR)[1]));
          }
        } else {
          this.setTimelineData(seriesDataAccumulator, crosstabResultData[seriesIndex][categoryIndex],
            parseInt(seriesId.split(MEASURE_SEPERATOR)[1]));
        }

        /* return structure is array of data of a series */
        return seriesDataAccumulator;
      }, [])
    } else {
      return categoriesResultBreak.reduce((seriesDataAccumulator, category, categoryIndex) => {
        /* Add data of column to series if data selected in data selector */
        if (!dataSelector.categories.isAllSelected) {
          if (dataSelector.categories.selectedData.includes(category.id)) {
            if (isRowAsCategories) {
              seriesDataAccumulator.push({
                name: category.text,
                value: this.roundNumber(crosstabResultData[categoryIndex][seriesIndex])
              })
            } else {
              seriesDataAccumulator.push({
                name: category.text,
                value: this.roundNumber(crosstabResultData[seriesIndex][categoryIndex])
              })
            }
          }
        } else {
          if (isRowAsCategories) {
            seriesDataAccumulator.push({
              name: category.text,
              value: this.roundNumber(crosstabResultData[categoryIndex][seriesIndex])
            })
          } else {
            seriesDataAccumulator.push({
              name: category.text,
              value: this.roundNumber(crosstabResultData[seriesIndex][categoryIndex])
            })
          }
        }

        /* return structure is array of data of a series */
        return seriesDataAccumulator;
      }, [])
    }
  }

  private setTimelineData(dataAccumulator: Array<any>, timelineData: Array<TimelineResult>
    , measureToDisplay: CrosstabMeasureTypes) {
    const date = new Date();
    for (const trendPoint of timelineData) {
      let categoryName = '';
      if (trendPoint._id.hour) {
        date.setUTCHours(trendPoint._id.hour);
        date.setUTCFullYear(trendPoint._id.year, trendPoint._id.month - 1, trendPoint._id.day);
        if (moment(date).diff(moment(), 'days') !== 0) {
          categoryName = moment(date).format('lll');
        } else {
          categoryName = moment(date).fromNow();
        }
      } else if (trendPoint._id.day) {
        date.setUTCFullYear(trendPoint._id.year, trendPoint._id.month - 1, trendPoint._id.day);
        categoryName = moment(date).format('ll');
      } else if (trendPoint._id.week) {
        categoryName = moment().utc().day('Monday').year(trendPoint._id.year).isoWeek(trendPoint._id.week).format('ll');
      } else if (trendPoint._id.month) {
        date.setUTCFullYear(trendPoint._id.year, trendPoint._id.month - 1,1);
        categoryName = moment(date).format('MMM, YYYY');
      } else {
        date.setUTCFullYear(trendPoint._id.year);
        categoryName = moment(date).format('YYYY');
      }
      dataAccumulator.push({
        name: categoryName,
        value: this.roundNumber(trendPoint[measureToDisplay])
      })
    }
  }

  private setTimelineChartConfig(chartOptions: EChartOption, chartType: ChartTypes, crossTabResult: CrosstabResult,
    dataSelector: DataSelector) {
    for (let rowIndex = 0; rowIndex < crossTabResult.rows.length; rowIndex++) {
      const row = crossTabResult.rows[rowIndex];

      /* skip if data row not selected in series of data selector and all selected data flag is also false*/
      if (!dataSelector.series.isAllSelected && !dataSelector.series.selectedData.includes(row.id)) {
        continue;
      }

      chartOptions.series = [...chartOptions.series, {
        ...this.getBasicSeriesConfig(chartType),
        id: row.id,
        name: row.text,
        data: this.getSeriesData(chartType, rowIndex, row.id, crossTabResult.columns, crossTabResult.data, dataSelector)
      }] as any;
    }
    if (chartOptions.series.length) {
      chartOptions['xAxis']['data'] = [];
      for (let i = 0; i < chartOptions.series[0]['data'].length; i++) {
        chartOptions['xAxis']['data'].push(chartOptions.series[0]['data'][i].name);
      }
    }
    this.addSpecificChartOptions(chartOptions, chartType);
  }

  private setRadarChartConfig(chartOptions: EChartOption, chartType: ChartTypes, crossTabResult: CrosstabResult,
    dataSelector: DataSelector) {
    chartOptions.series = [{
      ...this.getBasicSeriesConfig(chartType),
      data: []
    }]
    if (!dataSelector || (dataSelector && !dataSelector.rowAsCategories)) {
      for (let rowIndex = 0; rowIndex < crossTabResult.rows.length; rowIndex++) {
        const row = crossTabResult.rows[rowIndex];

        /* skip if data row not selected in series of data selector and all selected data flag is also false*/
        if (!dataSelector.series.isAllSelected && !dataSelector.series.selectedData.includes(row.id)) {
          continue;
        }
        chartOptions.series[0]['data'].push({
          name: row.text,
          value: this.getSeriesData(chartType, rowIndex, row.id, crossTabResult.columns, crossTabResult.data, dataSelector)
        })
      }
    } else if (dataSelector && dataSelector.rowAsCategories) {
      for (let columnIndex = 0; columnIndex < crossTabResult.columns.length; columnIndex++) {
        const column = crossTabResult.columns[columnIndex];

        /* skip if data row not selected in series of data selector and all selected data flag is also false*/
        if (!dataSelector.series.isAllSelected && !dataSelector.series.selectedData.includes(column.id)) {
          continue;
        }

        chartOptions.series[0]['data'].push({
          name: column.text,
          value: this.getSeriesData(chartType, columnIndex, column.id, crossTabResult.rows, crossTabResult.data, dataSelector)
        })
      }
    }

    // adding indicators in radar
    const indicators = [];
    if (dataSelector && dataSelector.rowAsCategories) {
      crossTabResult.rows.forEach(row => {
        indicators.push({ name: row.text });
      });
    } else {
      crossTabResult.columns.forEach(column => {
        indicators.push({ name: column.text });
      });
    }

    this.addSpecificChartOptions(chartOptions, chartType);
    // adding indicators for radar
    chartOptions.radar['indicator'] = indicators;
  }

  private setGaugeChartConfig(chartOptions: EChartOption, chartType: ChartTypes, crossTabResult: CrosstabResult,
    dataSelector: DataSelector) {
    chartOptions.series = [{
      ...this.getBasicSeriesConfig(chartType),
      data: []
    }]
    if (!dataSelector || (dataSelector && !dataSelector.rowAsCategories)) {
      for (let rowIndex = 0; rowIndex < crossTabResult.rows.length; rowIndex++) {
        const row = crossTabResult.rows[rowIndex];

        /* skip if data row not selected in series of data selector and all selected data flag is also false*/
        if (!dataSelector.series.isAllSelected && !dataSelector.series.selectedData.includes(row.id)) {
          continue;
        }
        chartOptions.series[0]['data'] = this.getSeriesData(chartType, rowIndex, row.id, crossTabResult.columns, crossTabResult.data, dataSelector);
      }
    } else if (dataSelector && dataSelector.rowAsCategories) {
      for (let columnIndex = 0; columnIndex < crossTabResult.columns.length; columnIndex++) {
        const column = crossTabResult.columns[columnIndex];

        /* skip if data row not selected in series of data selector and all selected data flag is also false*/
        if (!dataSelector.series.isAllSelected && !dataSelector.series.selectedData.includes(column.id)) {
          continue;
        }

        chartOptions.series[0]['data'] = this.getSeriesData(chartType, columnIndex, column.id, crossTabResult.rows, crossTabResult.data, dataSelector);
      }
    }
    this.addSpecificChartOptions(chartOptions, chartType);
  }

  private setSimpleChartConfig(chartOptions: EChartOption, chartType: ChartTypes,
    crossTabResult: CrosstabResult, dataSelector: DataSelector) {
    if (!dataSelector.rowAsCategories) {
      chartOptions.xAxis['data'] = crossTabResult.columns.map(function (data) {
        return data.text;
      });
      for (let rowIndex = 0; rowIndex < crossTabResult.rows.length; rowIndex++) {
        const row = crossTabResult.rows[rowIndex];

        /* skip if data row not selected in series of data selector and all selected data flag is also false*/
        if (!dataSelector.series.isAllSelected && !dataSelector.series.selectedData.includes(row.id)) {
          continue;
        }
        chartOptions.series = [...chartOptions.series, {
          ...this.getBasicSeriesConfig(chartType),
          id: row.id,
          name: row.text,
          data: this.getSeriesData(chartType, rowIndex, row.id, crossTabResult.columns, crossTabResult.data, dataSelector)
        }] as any;
      }
    } else if (dataSelector && dataSelector.rowAsCategories) {

      chartOptions.xAxis['data'] = crossTabResult.rows.map(function (data) {
        return data.text;
      });

      for (let columnIndex = 0; columnIndex < crossTabResult.columns.length; columnIndex++) {
        const column = crossTabResult.columns[columnIndex];
        /* skip if data row not selected in series of data selector and all selected data flag is also false*/
        if (!dataSelector.series.isAllSelected && !dataSelector.series.selectedData.includes(column.id)) {
          continue;
        }

        chartOptions.series = [...chartOptions.series, {
          ...this.getBasicSeriesConfig(chartType),
          id: column.id,
          name: column.text,
          data: this.getSeriesData(chartType, columnIndex, column.id, crossTabResult.rows, crossTabResult.data, dataSelector)
        }] as any;
      }
    }
    this.addSpecificChartOptions(chartOptions, chartType);
  }

  private addSpecificChartOptions(chartOptions: EChartOption, chartType: ChartTypes) {
    // setting chart options specific for simple charts
    if ([ChartTypes.SimplePie, ChartTypes.SimpleDoughnut].includes(chartType)) {
      chartOptions.tooltip.formatter = '{a} <br/>{b} : {c} ({d}%)';
    } else {
      chartOptions.tooltip.formatter = '{a} <br/>{b} : {c}';

      if ([ChartTypes.SimpleColumn, ChartTypes.StackedColumn].includes(chartType)) {
        chartOptions.xAxis['type'] = 'value';
        chartOptions.yAxis['type'] = 'category';
      } else if (chartType === ChartTypes.Radar) {
        // default tooltip properties are not supported in radar
        chartOptions.tooltip = {};
        // hiding x and y axis lines
        chartOptions.xAxis['splitLine'].show = false;
        chartOptions.yAxis['splitLine'].show = false;

        chartOptions.radar = {
          name: {
            textStyle: {
              color: '#fff',
              backgroundColor: '#999',
              borderRadius: 3,
              padding: [3, 5]
            }
          },
          radius: '58%'
        }
      } else if (chartType === ChartTypes.SimpleGauge) {
        // hiding x and y axis lines
        chartOptions.xAxis = undefined;
        chartOptions.yAxis = undefined;
      } else if ([ChartTypes.SimplePie, ChartTypes.SimpleDoughnut].includes(chartType)) {
        // hiding x and y axis lines
        chartOptions.xAxis = undefined;
        chartOptions.yAxis = undefined;
      } else if (chartType === ChartTypes.WordCloud) {
        // hiding x and y axis lines
        chartOptions.xAxis = undefined;
        chartOptions.yAxis = undefined;
        chartOptions.tooltip.formatter = '{b} : {c}';
      }
    }
  }

  private getBasicSeriesConfig(chartType: ChartTypes): EChartOption.Series {
    let newSeries: EChartOption.Series;
    switch (chartType) {
      case ChartTypes.Scatter:
        newSeries = new Object() as EChartOption.SeriesScatter;
        newSeries = {
          type: 'scatter'
        };
        break;

      case ChartTypes.SimpleLine:
      case ChartTypes.Timeline:
      case ChartTypes.TimelineChartRollback:
        newSeries = new Object() as EChartOption.SeriesLine;
        newSeries = {
          type: 'line'
        };
        break;

      case ChartTypes.SimpleArea:
        newSeries = new Object() as EChartOption.SeriesLine;
        newSeries = {
          type: 'line',
          areaStyle: {}
        };
        break;

      case ChartTypes.SimplePie:
        newSeries = new Object() as EChartOption.SeriesPie;
        newSeries = {
          type: 'pie',
          radius: ['0', '75%']
        };
        break;

      case ChartTypes.SimpleDoughnut:
        newSeries = new Object() as EChartOption.SeriesPie;
        newSeries = {
          type: 'pie',
          radius: ['50%', '70%']
        };
        break;

      case ChartTypes.SimpleBar:
      case ChartTypes.SimpleColumn:
        newSeries = new Object() as EChartOption.SeriesBar;
        newSeries = {
          type: 'bar'
        }
        break;

      case ChartTypes.StackedColumn:
      case ChartTypes.StackedBar:
        newSeries = new Object() as EChartOption.SeriesBar;
        newSeries = {
          type: 'bar',
          stack: 'true'
        }
        break;

      case ChartTypes.SimpleGauge:
        newSeries = new Object() as EChartOption.SeriesGauge;
        newSeries = {
          type: 'gauge',
          radius: '95%'
        };
        newSeries['axisLine'] = {
          lineStyle:
          {
            color: [[0.2, CHART_COLOR_PALETTE[0]], [0.8, CHART_COLOR_PALETTE[1]], [1, CHART_COLOR_PALETTE[2]]]
          }
        }
        break;

      case ChartTypes.Radar:
        newSeries = new Object() as EChartOption.SeriesRadar;
        newSeries = {
          type: 'radar'
        }
        break;

      case ChartTypes.WordCloud:
        newSeries = <any>{
          type: 'wordCloud',
          size: ['80%', '80%'],
          rotationRange: [0, 90],
          textPadding: 0,
          rotationStep: 90,
          autoSize: {
            enable: true,
            minSize: 14
          },
          textStyle: {
            normal: {
              fontFamily: 'fangsong',
              fontWeight: 'bold'
            }
          }
        }
    }
    return newSeries;
  }

  /* It round the float to 2 decimal places and returns int as it is */
  public roundNumber(num: number): number {
    if (num % 1 === 0) {
      return num;
    } else {
      return parseFloat(num.toFixed(2));
    }
  }

  public stripHtml(html) {
    // Create a new div element
    var temporalDivElement = document.createElement('div');
    // Set the HTML content with the providen
    temporalDivElement.innerHTML = html;
    // Retrieve the text property of the element (cross-browser support)
    return temporalDivElement.textContent || temporalDivElement.innerText || '';
  }

  public getRoundedNumber(place, value) {
    // console.log(place);
    return value.toFixed(place);
  }

  public DeepCopyFunction(inObject) {
    let outObject, value, key

    if (typeof inObject !== 'object' || inObject === null) {
      return inObject // Return the value if inObject is not an object
    }

    // Create an array or object to hold the values
    if (Array.isArray(inObject)) {
      outObject = [];
    } else if (inObject instanceof Date) {
      outObject = new Date(inObject.getTime());
    } else {
      outObject = {};
    }

    for (key in inObject) {
      value = inObject[key]

      // Recursively (deep) copy for nested objects, including arrays
      outObject[key] = this.DeepCopyFunction(value)
    }

    return outObject
  }
}
