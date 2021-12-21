var list = [{
        name: 'Dept & Specialty Stores',
        value: 59,
        id: 'industry1'
    },
    {
        name: 'Brokerage & Investments',
        value: 49,
        id: 'industry2'
    },
    {
        name: 'Tablet Computers',
        value: 48,
        id: 'industry3'
    },
    {
        name: 'Credit Cards',
        value: 43,
        id: 'industry4'
    },
    {
        name: 'Online Entertainment',
        value: 43,
        id: 'industry5'
    },
    {
        name: 'Auto Insurance',
        value: 41,
        id: 'industry6'
    },
    {
        name: 'Laptop Computers',
        value: 41,
        id: 'industry7'
    },
    {
        name: 'Smartphones',
        value: 41,
        id: 'industry8'
    },
    {
        name: 'Grocery and Supermarket',
        value: 40,
        id: 'industry9'
    },
    {
        name: 'Online Shopping',
        value: 40,
        id: 'industry10'
    },
    {
        name: 'Banking',
        value: 36,
        id: 'industry11'
    },
    {
        name: 'Hotels',
        value: 36,
        id: 'industry12'
    },
    {
        name: 'Ioms and Contents Insurance',
        value: 35,
        id: 'industry13'
    },
    {
        name: 'Software & Apps',
        value: 34,
        id: 'industry14'
    },
    {
        name: 'Shipping Services',
        value: 33,
        id: 'industry15'
    },
    {
        name: 'Life Insurance',
        value: 32,
        id: 'industry16'
    },
    {
        name: 'Cell Phone Service',
        value: 30,
        id: 'industry17'
    },
    {
        name: 'Drugstore and Pharmacy',
        value: 29,
        id: 'industry18'
    },
    {
        name: 'Airlines',
        value: 27,
        id: 'industry19'
    },
    {
        name: 'Travel Websites',
        value: 24,
        id: 'industry20'
    },
    {
        name: 'Health Insurance',
        value: 19,
        id: 'industry21'
    },
    {
        name: 'Cable & Satellite TV',
        value: 1,
        id: 'industry22'
    },
    {
        name: 'Internet Services',
        value: 1,
        id: 'industry23'
    }
];
var overallNps = 0;
var selectedIndustry = null;

function initializePage() {
    list.sort((a, b) => (a.name > b.name) ? 1 : ((b.name > a.name) ? -1 : 0));
    createList();
    ValueChanged();
}

function SetCleanedNumber(i) {
    var value = document.getElementById(`input${i}`).value;
    var tempVal = '';
    for (let index = 0; index <= value.length - 1; index++) {
        if (Number(value[index]) <= 9 && value[index] !== ' ') {
            tempVal += value[index];
        }
    }
    document.getElementById(`input${i}`).value = tempVal;
    return Number(tempVal);
}

function ValueChanged() {
    var promoter = 0;
    var passive = 0;
    var detractor = 0;
    var total = 0;

    for (var i = 0; i <= 10; i++) {
        var value = SetCleanedNumber(i);;
        total += value;
        if (i < 7) {
            detractor += value;
        } else if (i < 9) {
            passive += value;
        } else {
            promoter += value;
        }
    }

    if (total === 0) {
        promoter = 0;
        detractor = 0;
        passive = 0;
    } else {
        promoter = roundNumber((promoter / total) * 100, 1);
        detractor = roundNumber((detractor / total) * 100, 1);
        passive = roundNumber((passive / total) * 100, 1);
    }

    document.getElementById('detractor').innerHTML = detractor + '%';
    document.getElementById('passive').innerHTML = passive + '%';
    document.getElementById('promoter').innerHTML = promoter + '%';

    overallNps = promoter - detractor;

    CreateGauge(overallNps);
    OnClickIndustry();

}

function roundNumber(value, decimalPlace) {
    tens = Math.pow(10, decimalPlace);
    return Math.round(value * tens) / tens;
}

function createList() {
    var ul = document.getElementById("Industry-dropdown");
    while (ul.firstChild) ul.removeChild(ul.firstChild);

    GetFiltersIndustryList().forEach(element => {
        var node = document.createElement('li');
        node.id = element.id;
        var anchorTag = document.createElement('a');
        anchorTag.innerHTML = element.name;
        anchorTag.href = 'javascript:void(0)';
        node.appendChild(anchorTag);
        node.onclick = function () {
            OnClickIndustry(element)
        };
        ul.appendChild(node);
    });
}

function GetFiltersIndustryList() {
    var tempList = [];
    var searchText = document.getElementById('searchInput').value.trim().toLowerCase();
    if (searchText) {
        list.forEach((item) => {
            if (item.name.toLowerCase().includes(searchText)) {
                tempList.push(item);
            }
        });
        return tempList;
    } else {
        return list;
    }
}

function OnClickIndustry(industry = null) {
    if (industry) {
        document.getElementById('selected-industry').innerHTML = industry.name;
        selectedIndustry = industry;
    }

    if (selectedIndustry) {
        var comparisionText = '';
        if (selectedIndustry.value < overallNps) {
            if (overallNps - selectedIndustry.value < 2) {
                comparisionText = 'very close to';
            } else {
                comparisionText = 'Higher than';
            }
        } else if (selectedIndustry.value > overallNps) {
            if (selectedIndustry.value - overallNps < 2) {
                comparisionText = 'very close to';
            } else {
                comparisionText = 'less than';
            }
        } else {
            comparisionText = 'equal to';
        }
        document.getElementById('comparision-text').innerHTML = `Your organisation’s score is <strong id="metricText">${comparisionText}</strong> the ${selectedIndustry.name} industry’s average NPS of <strong>${selectedIndustry.value}</strong>`;
        document.getElementById('comparision-text-mob').innerHTML = `Your organisation’s score is <strong id="metricText">${comparisionText}</strong> the ${selectedIndustry.name} industry’s average NPS of <strong>${selectedIndustry.value}</strong>`;
        CreateGauge(overallNps);
    }
}

function CreateGauge(value) {
    options = {
        "grid": {
            "containLabel": true,
            "top": 18,
            "bottom": 20,
            "left": 10,
            "right": 30
        },
        "legend": {
            "show": true,
            "type": "scroll",
            "bottom": 0,
            "align": "right"
        },
        "tooltip": {
            "trigger": "item",
            "axisPointer": {
                "type": "cross",
                "label": {
                    "backgroundColor": "#6a7985"
                }
            },
            "formatter": "{a} <br/>{b} : {c}"
        },
        "color": [
            "#403294"
        ],
        "series": [{
            "type": "gauge",
            "radius": "75%",
            "axisLine": {
                "lineStyle": {
                    "color": [
                        [
                            0.2,
                            "#403294"
                        ],
                        [
                            0.8,
                            null
                        ],
                        [
                            1,
                            null
                        ]
                    ]
                }
            },
            "data": [{
                "name": "Total",
                "value": 90
            }]
        }]
    }
    options.series[0]['min'] = -100;
    options.series[0]['max'] = 100;
    options.series[0]['axisLine']['lineStyle'].color[0] = [0.5, '#FF5630'];
    options.series[0]['axisLine']['lineStyle'].color[1] = [0.7, '#FFAB00'];
    options.series[0]['axisLine']['lineStyle'].color[2] = [1, '#36B37E'];
    options.series[0]['axisLine']['lineStyle']['width'] = 12;
    options.series[0]['title'] = [];
    // options.series[0]['radius'] = '120%';
    options.series[0]['startAngle'] = '200';
    options.series[0]['endAngle'] = '-20';
    options.tooltip.formatter = '{b} : {c}';
    options.series[0]['axisTick'] = {
        show: true,
        splitNumber: 1
    };
    options.series[0]['splitLine'] = {
        length: 20
    };

    if (options.series[0]['data'].length > 0) {
        options.series[0]['data'][0]['name'] = 'Your NPS Score';
    }

    options.series[0]['title'] = {
        show: true,
        offsetCenter: [0, '80%'],
        color: '#2E384D',
        fontSize: 20,
        fontWeight: 'bolder',
    };
    options.series[0]['detail'] = {
        formatter: options.series[0]['data'][0].value,
        textStyle: {
            color: '#2E384D',
            fontSize: 25,
            fontWeight: 'bolder'
        },
        offsetCenter: [0, '35%'],
    };
    options.series[0]['itemStyle'] = {
        color: '#CCCCCC',
    };

    options.series[0]['pointer'] = {
        length: '70%',
        width: 6
    };
    options.series[0]['center'] = ['50%', '50%'];
    options.series[0].data[0].value = roundNumber(value, 2);

    if (selectedIndustry) {
        selectedAngle = selectedIndustry.value * 1.1;
        if (selectedAngle < 0) {
            selectedAngle *= -1;
        }
        radius = 39;

        yPoint = 50 - (radius * Math.cos(selectedAngle * Math.PI / 180));
        xPoint = 0;
        if (selectedIndustry.value < 0) {
            xPoint = 50 - (radius * Math.sin(selectedAngle * Math.PI / 180));
            selectedAngle *= -1;
        } else {
            xPoint = 50 + (radius * Math.sin(selectedAngle * Math.PI / 180));
        }

        labelPosition = [];
        if (selectedIndustry.value < 0) {
            labelPosition = [-5, -10];
        } else {
            labelPosition = [15, -10];
        }

        options.series[0].markPoint = {
            tooltip: `${selectedIndustry.name}: ${selectedIndustry.value}`,
            itemStyle: {
                color: '#091E42'
            },
            label: {
                show: true,
                position: labelPosition,
            },
            symbolRotate: -1 * selectedAngle,
            symbol: 'image://./assets/img/pointer.svg',
            symbolSize: 25,
            data: [{
                name: selectedIndustry.name,
                x: `${xPoint}%`,
                y: `${yPoint}%`,
                value: selectedIndustry.value
            }]
        }
    }

    var chart = echarts.init(document.getElementById('chart'));
    chart.setOption(options);
}

function EmptySearchInput() {
    document.getElementById('searchInput').value = '';
    createList();
}