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
        <li><a href="{{ site_url }}report/all_list/">レポート一覧</a></li>
        <li><a href="{{ site_url }}report/ranking/">ランキング</a></li>
        <li><a href="{{ site_url }}setting/">設定</a></li>
      </ul>
    </div>
  </div>
</nav>

<div class="row">
  <div class="col-md-2">
    <p>{{ profile.name }}</p>
    <p><a href="{{ site_url }}report/my_list/">マイレポート一覧</a></p>
    <p><a href="{{ site_url }}report/write/">レポートを書く</a></p>
    <p>お気に入り一覧</p>
{% for row in favorite %}
    <p><a href="{{ site_url }}report/favorite/?id={{ row.id }}">{{ row.name }}</a></p>
{% endfor %}
    <p><a href="{{ site_url }}logout/">ログアウト</a></p>
  </div>
  <div class="col-md-6">
{% for report in newReport %}
    <p><a href="{{ site_url }}report/view/?id={{ report.id }}">{{ report.title }}</a></p>
{% endfor %}
  </div>
</div>
