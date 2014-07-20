define ['jquery','underscore','deepmodel','domReady!', 'common',
        'jqueryui','jsrender','bootstrap','jqcookie','json2'], ($, _, svc)->
  class headerView extends Backbone.View
    el: '#header'
    tmpUrl: 'template/header.html'
    initialize: ->
      @$el.load(@tmpUrl)

    $.app.header       = new headerView()