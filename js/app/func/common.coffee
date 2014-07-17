define ['jquery','jsrender'], ($)->
  $.app = $.app || {}
  $.app.views = $.app.views || {}
  $.app.data = {}
  $.app.service = {}

  $.app.service =
    list: "api/list.php"
    share: "api/share.php"
    save: "api/save.php"
    getshare: "api/getshare.php"

  $.views.helpers
    getPos: (s, h)->
      w = if h then 1000 else 600
      s = Math.floor(Math.random() * 2000) % w
      return s