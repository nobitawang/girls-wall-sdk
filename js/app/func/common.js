// Generated by CoffeeScript 1.7.1
(function() {
  define(['jquery', 'jsrender'], function($) {
    $.app = $.app || {};
    $.app.views = $.app.views || {};
    $.app.data = {};
    $.app.service = {};
    $.app.service = {
      list: "api/list.php",
      share: "api/share.php",
      save: "api/save.php",
      getshare: "api/getshare.php"
    };
    return $.views.helpers({
      getPos: function(s, h) {
        var w;
        w = h ? 1000 : 600;
        s = Math.floor(Math.random() * 2000) % w;
        return s;
      }
    });
  });

}).call(this);
