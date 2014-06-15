<p>{{ profile.name }}</p>
<p><a href="{{ site_url }}report/myList/">マイレポート一覧</a></p>
<p><a href="{{ site_url }}report/write/">レポートを書く</a></p>
<p><a href="{{ site_url }}logout/">ログアウト</a></p>
<div>
{% for report in newReport %}
  <p><a href="{{ site_url }}report/view/?id={{ report.id }}">{{ report.title }}</a></p>
{% endfor %}
</div>
<div>

</div>
