// Generated by CoffeeScript 1.7.1
(function() {
  var __bind = function(fn, me){ return function(){ return fn.apply(me, arguments); }; },
    __hasProp = {}.hasOwnProperty,
    __extends = function(child, parent) { for (var key in parent) { if (__hasProp.call(parent, key)) child[key] = parent[key]; } function ctor() { this.constructor = child; } ctor.prototype = parent.prototype; child.prototype = new ctor(); child.__super__ = parent.prototype; return child; };

  define(['jquery', 'underscore', 'deepmodel', 'domReady!', 'common', 'jqueryui', 'jsrender', 'bootstrap', 'jqcookie', 'json2'], function($, _, svc) {
    var asideView;
    return asideView = (function(_super) {
      __extends(asideView, _super);

      function asideView() {
        this.addItem = __bind(this.addItem, this);
        this.leave = __bind(this.leave, this);
        this.over = __bind(this.over, this);
        this.getKey = __bind(this.getKey, this);
        this.rendererBox = __bind(this.rendererBox, this);
        return asideView.__super__.constructor.apply(this, arguments);
      }

      asideView.prototype.el = '#aside';

      asideView.prototype.tmpUrl = 'template/aside.html';

      asideView.prototype.images = [];

      asideView.prototype.itemTmpId = '#box-item-template';

      asideView.prototype.myKey = '';

      asideView.prototype.initialize = function() {
        this.$el.load(this.tmpUrl);
        this.getKey();
        this.rendererBox();
        return Backbone.on("addItem", this.addItem, this);
      };

      asideView.prototype.events = {
        "mouseover .boxBar": "over",
        "click .boxBar": "leave"
      };

      asideView.prototype.rendererBox = function() {
        return $.get($.app.service.save).done((function(_this) {
          return function(data) {
            if (data) {
              _this.$('.mybox').html($(_this.itemTmpId).render(data));
              return _this.images = _.pluck(data, 'id');
            }
          };
        })(this));
      };

      asideView.prototype.getKey = function() {
        return $.get($.app.service.share).done((function(_this) {
          return function(data) {
            _this.myKey = data;
            return _this.$('.shareBar .nav a').attr('href', 'share.html?id=' + _this.myKey);
          };
        })(this));
      };

      asideView.prototype.over = function(e) {
        return $(e.target).add($(e.target).siblings()).addClass('onMouseover');
      };

      asideView.prototype.leave = function(e) {
        return $(e.target).add($(e.target).siblings()).removeClass('onMouseover');
      };

      asideView.prototype.addItem = function($item) {
        var $clone, id;
        id = $item.data('id');
        $clone = $item.clone();
        if (-1 === _.indexOf(this.images, id)) {
          $clone.attr('style', '');
          this.$('.mybox').append($clone);
          this.images.push(id);
          $item.remove();
          return $.post($.app.service.save, {
            ids: this.images.toString()
          }).done(function(data) {});
        }
      };

      $.app.aside = new asideView();

      return asideView;

    })(Backbone.View);
  });

}).call(this);