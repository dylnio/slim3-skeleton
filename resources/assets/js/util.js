'use strict'
var UTIL = {
    timestampToDate: function (ts, format) {
        format = format || 'D/M/YYYY';
        var date = moment.unix(ts);
        return date.format(format);
    },
    cover: function (show) {
        if (show == undefined) {
            show = true;
        }
        var $cover = $('#cover');
        if (show) {
            $cover.show();
        } else {
            $cover.hide();
        }
    },
    stopEvent: function (e) {
        e.stopPropagation();
        e.preventDefault();
    },
    isNumber: function (n) {
        return !isNaN(parseFloat(n)) && isFinite(n);
    },
    changeUrl: function (url) {
        var title = null;
        if (window.history.replaceState) {
            //prevents browser from storing history with each change:
            window.history.replaceState({}, title, url);
        }
    }
};