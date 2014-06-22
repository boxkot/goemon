<style>
.box {
   width: 400px;
   height: 600px;
   border-style: solid;
}
.box-head {
   padding-top: 100px;
   width: 300px;
   height: 150px;
}
.batu {
   background-color: #999;
}
</style>

<div class="col-md-4 col-md-offset-1 favorite-area" id="{{ id }}">
  <div class="box-head">
  </div>
  <h3>お気に入りユーザー</h3>
  <div id="favorite-box" class="box">
{% for user in favorite %}
    <span id="user-{{ user.user_id }}" class="label label-default">{{ user.name }}<button id="{{ user.id}}" class="batu">&times;</button></span>
{% endfor %}
  </div>
</div>
<div class="col-md-4">
  <div class="box-head">
    <form action="" class="form-horizontal" role="form">
    </form>
  </div>
  <h3>ユーザー</h3>
  <div class="box" id="user-box">
{% for key, user in data %}
    <span id="user-{{ user.id }}" class="label label-default">{{ user.name }}</span>
{% endfor %}
  </div>
</div>
