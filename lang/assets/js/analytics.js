function Analytics(){
	var self= this;
	var timeout = 0;
    var status = 0;
    var running = 0;
	this.init= function(){
        if($('.analytics-page').length > 0){
            self.chart();
        }
	};

    this.chart = function(){
        _timeout = 0;
        setTimeout(function(){ self.ajax_chart('reachchart'); },_timeout);

        _timeout += 2000;
        setTimeout(function(){ self.ajax_chart('postschart'); },_timeout);

        _timeout += 2000;
        setTimeout(function(){ self.ajax_chart('tabchart'); },_timeout);

        _timeout += 4000;
        setTimeout(function(){ self.ajax_chart('fanschart'); },_timeout);

        _timeout += 2000;
        setTimeout(function(){ self.ajax_chart('likeschart'); },_timeout);

        _timeout += 2000;
        setTimeout(function(){ self.ajax_chart('genderchart'); },_timeout);

        _timeout += 2000;
        setTimeout(function(){ self.ajax_chart('countrychart'); },_timeout);

        _timeout += 2000;
        setTimeout(function(){ self.ajax_chart('citychart'); },_timeout);
        
        _timeout += 2000;
        setTimeout(function(){ self.ajax_chart('sourcechart'); },_timeout);
    };

    this.ajax_chart = function(element){
        $('.' + element).html('');
        self.startPageLoading('.' + element);
        _daterange = $('.daterange').val();
        _data = $.param({token:token, daterange: _daterange});
        $.post(PATH + 'analytics/ajax_' + element, _data, function(data){
            $('.' + element).html(data);
            self.stopPageLoading('.' + element);
        });
    };

    this.Highcharts = function(options){
        $(options.element).highcharts({
            chart: {
                zoomType: 'x',
                height  : (options.height)?options.height:350
            },
            title: {
                text: (options.title)?options.title:''
            },
            subtitle: {
                text: (options.subtitle)?options.subtitle:''
            },
            xAxis: {
                type: (options.titlex)?options.titlex:'',
                dateTimeLabelFormats: {
                    day: (options.format)?options.format:'%b %e',
                },
                tickInterval: (options.tick)?1:0,
                labels: {
                    enabled: true,
                    formatter: function() { return (options.formatterx)?options.data[this.value][0]:moment(this.value).format("MMM D"); },
                }
            },
            yAxis: {
                title: {
                    text: (options.titley)?options.titley:''
                }
            },
            legend: {
                enabled: true
            },
            tooltip: {
                crosshairs: (options.crosshairs)?true:false,
                shared: true
            },
            plotOptions: {
                spline: {
                    marker: {
                        radius: 4,
                        lineColor: '#666666',
                        lineWidth: 1
                    }
                },
                line: {
                    marker: {
                        radius: 4,
                        lineColor: '#666666',
                        lineWidth: 1
                    },
                    color: (options.colory)?options.colory:Highcharts.getOptions().colors[5]
                },
                area: {
                    fillColor: {
                        linearGradient: {
                            x1: 0,
                            y1: 0,
                            x2: 0,
                            y2: 1
                        },
                        stops: [
                            [0, (options.colorx)?options.colorx:Highcharts.getOptions().colors[5]],
                            [1, Highcharts.Color((options.colory)?options.colory:Highcharts.getOptions().colors[5]).setOpacity(1).get('rgba')]
                        ]
                    },
                    marker: {
                        radius: 0
                    },
                    color: (options.colory)?options.colory:Highcharts.getOptions().colors[5],
                    lineWidth: 1,
                    states: {
                        hover: {
                            lineWidth: 0
                        }
                    },
                    threshold: null
                },
                pie: {
                    tooltip: {
                        valueSuffix: '%',
                        pointFormatter: function() {
                            return '<span style="color: '+this.series.tooltipOptions.backgroundColor+'">\u25CF</span> '+this.series.name+': <b>'+self.round(this.percentage,2)+'%</b><br/>.'
                        }
                    },
                }
            },

            series: (options.multi)?options.data:[{ type: (options.type)?options.type:'line',name: (options.name)?options.name:'', data: (options.data)?options.data:'', dataLabels: (options.dataLabels)?options.dataLabels:'{point.y}' }]
        });
        list_chart.push(options.element);
    };

    this.colorTop = function(index){
        switch(index){
            case 1:
                color = 'red';
                break;
            case 2:
                color = 'green';
                break;
            case 3:
                color = 'blue';
                break;
            default:
                color = 'grey';
                break;
        }
        return color;
    };

    this.round = function(value, decimals) {
        return Number(Math.round(value + 'e' + decimals) + 'e-' + decimals);
    };

    this.resizeChart = function(){
        setTimeout(function(){ 
            jQuery(window).trigger("resize"); 
                var _width = $('.item-metric').width() - 30;
                for (var i = 0; i < list_chart.length; i++) {
                var chart = jQuery(list_chart[i]).highcharts();
                chart.reflow()
            };
        }, 300);
    };

    this.resize = function(){
        $(window).resize(function(){
            $('.listCore').height($(window).height());
            $('.listCore').width($('.box-listCore').width());
        });
    };

    this.formatNumber = function(number)
    {
        var number = number.toFixed(0) + '';
        var x = number.split('.');
        var x1 = x[0];
        var x2 = x.length > 1 ? '.' + x[1] : '';
        var rgx = /(\d+)(\d{3})/;
        while (rgx.test(x1)) {
            x1 = x1.replace(rgx, '$1' + ',' + '$2');
        }
        return x1 + x2;
    };

    this.CountValue = function(element, data){
        var CountValue = 0;
        $.each(data, function(index,value){
            CountValue += value[1];
        });
        $("."+element).html(self.formatNumber(CountValue));
    };

    this.MostValue = function(element, data){
        var MostValue = 0;
        var Key = 0;
        $.each(data, function(index,value){
            if(MostValue < value[1]){
                MostValue = value[1];
                Key = value[0];
            }
        });
        $("."+element).html(self.formatNumber(Key));
    };

    this.AvgValue = function(element, data){
        var MostValue = 0;
        var Key = 0;
        $.each(data, function(index,value){
            Key++;
            MostValue += value[1];
        });
        $("."+element).html(Math.round(MostValue/Key));
    };

    this.startPageLoading = function(element) {
        $(element).append('<div class="loading-analytics"><div class="md-preloader pl-size-md"><svg viewbox="0 0 75 75"><circle cx="37.5" cy="37.5" r="33.5" class="pl-red" stroke-width="5" /></svg></div></div>');
    };

    this.stopPageLoading = function(element) {
        $(element + ' .loading-analytics').remove();
    };
}
Analytics= new Analytics();
$(function(){
	Analytics.init();
});