define ['jquery','underscore','deepmodel','domReady!', 'common',
        'jqueryui','jsrender','bootstrap','jqcookie','json2'], ($, _, svc)->
  class articleView extends Backbone.View
    el: '#article'
    tmpUrl: 'template/article.html'
    itemTmpId: '#item-template'
    initialize: ->
      @$el.load(@tmpUrl)
      $.get($.app.service.list)
      .done((data)=>
        shuffle = _.shuffle(data)
        @$('.container').html($(@itemTmpId).render(shuffle))
        .find('img').draggable(
          start: (e, ui)=>
            $(e.target).addClass('onActive')
          stop: (e, ui)=>
            $(e.target).removeClass('onActive')
            pos = $(e.target).position()
            console.log e.target.x
#            console.log pos
            if e.target.x < 350 and $('.mybox').hasClass('onMouseover')
              Backbone.trigger('addItem', $(e.target))
        )
      )
#    events:
#      "click img.img-rounded": "active"
#    active: (e)=>
#      $(e.target).addClass('onActive')

    $.app.article       = new articleView()