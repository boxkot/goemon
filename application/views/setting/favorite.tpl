<style>
.box {
   background: white;
}
</style>
<div class="col-md-2 col-md-offset-1">
  <p class="lead" id="favorite-add"><a href="{{ site_url }}favorite/add/">新規追加</a></p>
  <table class="table table-hover">
{% for favorite in data %}
    <tr>
      <td><a href="{{ site_url }}favorite/edit/?id={{ favorite.id }}">{{ favorite.name }}</a></td>
    </tr>
{% endfor %}
  </table>
</div>

<div class="box" style="display: none" id="favorite-add-form">
  <form action="{{ site_url }}favorite/add/" method="post">
    <div class="form-group">
      <label for="name" class="col-sm-2 control-label">お気に入りグループ名</label>
      <div class="col-sm-5">
        <input type="text" name="name" class="form-control" id="name" value="{{ data.name }}">
      </div>
    </div>

    <div class="form-group">
      <div class="col-sm-offset-2 col-sm-10">
        <input id="favorite-add-btn" type="submit" class="btn btn-primary" value="新規追加">
      </div>
    </div>
  </form>
</div>
