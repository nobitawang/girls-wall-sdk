// Generated by CoffeeScript 1.7.1
(function() {
  var __hasProp = {}.hasOwnProperty,
    __extends = function(child, parent) { for (var key in parent) { if (__hasProp.call(parent, key)) child[key] = parent[key]; } function ctor() { this.constructor = child; } ctor.prototype = parent.prototype; child.prototype = new ctor(); child.__super__ = parent.prototype; return child; };

  define(['jquery', 'underscore', 'deepmodel', 'domReady!', 'common', 'jqueryui', 'jsrender', 'bootstrap', 'jqcookie', 'json2'], function($, _, svc) {
    var articleView;
    return articleView = (function(_super) {
      __extends(articleView, _super);

      function articleView() {
        return articleView.__super__.constructor.apply(this, arguments);
      }

      articleView.prototype.el = '#article';

      articleView.prototype.tmpUrl = 'template/article.html';

      articleView.prototype.itemTmpId = '#item-template';

      articleView.prototype.initialize = function() {
        this.$el.load(this.tmpUrl);
        return $.get($.app.service.list).done((function(_this) {
          return function(data) {
            var shuffle;
            shuffle = _.shuffle(data);
            return _this.$('.container').html($(_this.itemTmpId).render(shuffle)).find('img').draggable({
              start: function(e, ui) {
                return $(e.target).addClass('onActive');
              },
              stop: function(e, ui) {
                var pos;
                $(e.target).removeClass('onActive');
                pos = $(e.target).position();
                console.log(e.target.x);
                if (e.target.x < 350 && $('.mybox').hasClass('onMouseover')) {
                  return Backbone.trigger('addItem', $(e.target));
                }
              }
            });
          };
        })(this));
      };

      $.app.article = new articleView();

      return articleView;

    })(Backbone.View);
  });

}).call(this);