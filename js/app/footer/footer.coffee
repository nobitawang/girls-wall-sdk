define ['jquery','underscore','deepmodel','domReady!', 'common',
        'jqueryui','jsrender','bootstrap','jqcookie','json2'], ($, _, svc)->
  class headerView extends Backbone.View
    el: '#footer'
    tmpUrl: 'template/footer.html'
    initialize: ->
      @$el.load(@tmpUrl)
    $.app.header       = new headerView()