define ['jquery','underscore','deepmodel','domReady!', 'common',
        'jqueryui','jsrender','bootstrap','jqcookie','json2', 'lightbox'], ($, _, svc)->
  class mainView extends Backbone.View
    el: '.image-row'
    itemTmpId: '#box-item-template'
    initialize: ->
      @key = location.search.match(/\=(.*)?/)[1]
      @getImages()
    getImages: ()=>
      $.get($.app.service.getshare + '?id=' + @key)
      .done (data)=>
        @$el.html($(@itemTmpId).render(data)) if data

#    events:
#      "click img.img-rounded": "active"
#    active: (e)=>
#      $(e.target).addClass('onActive')
    $.app.main       = new mainView()