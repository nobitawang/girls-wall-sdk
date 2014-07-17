define ['jquery','underscore','deepmodel','domReady!', 'common',
        'jqueryui','jsrender','bootstrap','jqcookie','json2'], ($, _, svc)->
  class asideView extends Backbone.View
    el: '#aside'
    tmpUrl: 'template/aside.html'
    images: []
    itemTmpId: '#box-item-template'
    myKey: ''
    initialize: ->
      @$el.load(@tmpUrl)
      @getKey()
      @rendererBox()
      Backbone.on("addItem", @addItem, @)
    events:
      "mouseover .boxBar": "over"
      "click .boxBar": "leave"
#      "dropdown .mybox": "addItem"
    rendererBox: ()=>
      $.get($.app.service.save)
      .done((data)=>
          if data
            @$('.mybox').html $(@itemTmpId).render(data)
            @images = _.pluck(data, 'id')
        )
    getKey: ()=>
      $.get($.app.service.share)
      .done (data)=>
          @myKey = data
          @$('.shareBar .nav a').attr('href', 'share.html?id=' + @myKey)
    over: (e)=>
      $(e.target).add($(e.target).siblings()).addClass('onMouseover')
    leave: (e)=>
      $(e.target).add($(e.target).siblings()).removeClass('onMouseover')
    addItem: ($item)=>
      id = $item.data('id')
      $clone = $item.clone()
      if -1 is _.indexOf(@images, id)
        $clone.attr('style', '')
        @$('.mybox').append($clone)
        @images.push(id)
        $item.remove();
        $.post($.app.service.save,{
          ids: @images.toString()
        }).done((data)->
#          console.log data
        )


    $.app.aside       = new asideView()