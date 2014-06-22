<nav class="navbar navbar-default" role="navigation">
  <div class="container-fluid">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="{{ site_url}}user/">GOEMON</a>
    </div>
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav">
        <li><a href="">新着お知らせ</a></li>
        <li><a href="">レポート一覧</a></li>
        <li><a href="">ランキング</a></li>
      </ul>
    </div>
  </div>
</nav>

<table class="table table-hover">
{% for key, report in data %}
  <tr>
    <td>{{ key + 1 }}</td>
    <td>{{ report.user_name }}</td>
    <td><a href="{{ site_url }}report/view/?id={{ report.id }}">{{ report.title }}</a></td>
    <td>{{ report.read_num }}</td>
    <td>{{ report.comment_num }}</td>
  </tr>
{% endfor %}
</table>
