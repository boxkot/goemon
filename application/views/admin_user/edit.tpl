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

<table class="table table-hover">
  <tr>
    <th>ID</th>
    <th>名前</th>
    <th>役職</th>
    <th>部署</th>
    <th>更新</th>
    <th>削除</th>
  </tr>
{% for user in data %}
  <tr>
    <td>{{ user.id }}</td>
    <td>{{ user.name }}</td>
    <td>
      <select name="grade_id" class="form-control">
{% for row in grade %}
        <option value="{{ row.id }}"{% if user.grade_id == row.id %} selected{% endif %}>{{ row.name }}</option>
{% endfor %}
      </select>
    </td>
    <td>
      <select name="unit_id" class="form-control">
{% for row in unit %}
        <option value="{{ row.id }}"{% if user.unit_id == row.id %} selected{% endif %}>{{ row.name }}</option>
{% endfor %}
      </select>
    </td>
    <td>
      <button class="btn btn-warning">更新</button>
    </td>
    <td>
      <button class="btn btn-danger">削除</button>
    </td>
  </tr>
{% endfor %}
</table>
