<div class="col-md-5 col-md-offset-1">
  <form class="form-horizontal" role="form" method="post">
    <div class="form-group">
      <label for="name" class="col-sm-2 control-label">名前</label>
      <div class="col-sm-5">
        <input type="text" name="name" class="form-control" id="name" value="{{ data.name }}">
      </div>
    </div>
    <div class="form-group">
      <label for="mail" class="col-sm-2 control-label">メールアドレス</label>
      <div class="col-sm-5">
        <input type="mail" name="mail" class="form-control" id="mail" value="{{ data.mail }}">
      </div>
    </div>

    <div class="form-group">
      <div class="col-sm-offset-2 col-sm-10">
        <input type="submit" class="btn btn-primary" value="変更する">
    </div>
  </form>
</div>
