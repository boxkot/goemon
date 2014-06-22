<nav class="navbar navbar-default" role="navigation">
  <div class="container-fluid">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="{{ site_url}}admin/top/">GOEMON</a>
    </div>
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav">
        <li><a href="{{ site_url }}admin_user/add/">新規ユーザー追加</a></li>
        <li><a href="{{ site_url }}admin_user/edit/">ユーザー管理</a></li>
        <li><a href="{{ site_url }}admin/add/">管理者追加</a></li>
        <li><a href="{{ site_url }}admin/edit/">管理者管理</a></li>
      </ul>
    </div>
  </div>
</nav>

<form action="{{ site_url }}admin/add/" method="post" class="form-horizontal" role="role" style="width: 800px">
  <div class="form-group">
    <label for="mail" class="col-sm-2 control-label">メールアドレス</label>
    <div class="col-sm-10">
      <input type="text" name="mail" class="form-control" id="mail" value="">
    </div>
  </div>

  <div class="form-group">
    <label for="auth" class="col-sm-2 control-label">権限</label>
    <div class="col-sm-10">
      <select class="form-control">
{% for row in auth %}
        <option value="{{ row.id }}">{{ row.name }}</option>
{% endfor %}
      </select>
    </div>
  </div>

  <div class="form-group">
    <div class="col-sm-offset-2 col-sm-10">
      <input type="submit" class="btn btn-primary btn-lg btn-block" value="管理者追加">
    </div>
  </div>
</form>
