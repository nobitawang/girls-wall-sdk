define ['jquery','underscore','deepmodel','domReady!', 'common',
        'jqueryui','jsrender','bootstrap','jqcookie','json2', 'jssdk'], ($, _, svc)->
  class articleView extends Backbone.View
    el: '#article'
    tmpUrl: 'template/article.html'
    itemTmpId: '#item-template'
    initialize: ->
      @$el.load(@tmpUrl)
      pixnet.mainpage.getAlbumsByCategory((data)=>
        # ============================= callback logic =============================
        len = data.length
        index = data.length

        while index--
          item = data[index]
          item.id = index
          item.score = (len - index) % 15 * 20
          item.thumb = item.thumb.replace(/[\d]+x[\d]+/g, "300x300")

        shuffle = _.shuffle(data)
        @$('.container').html($(@itemTmpId).render(shuffle))
        .find('img').draggable(
          start: (e, ui)=>
            $(e.target).addClass('onActive')
          stop: (e, ui)=>
            $(e.target).removeClass('onActive')
            pos = $(e.target).position()
            if e.target.x < 350 and $('.mybox').hasClass('onMouseover')
              Backbone.trigger('addItem', $(e.target))
        )
        # ============================= callback logic END =============================
      , 'hot', 1, {
        count: 200
        strict_filter: 1
        ios: 1
      })

    events:
      "click img.img-rounded": "active"
    active: (e)=>
      $(e.target).addClass('onActive')

    $.app.article       = new articleView()