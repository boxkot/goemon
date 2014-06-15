<div>
  <p>{{ report.unit_name}}：{{ report.name }}</p>
  <p>{{ report.title }}</p>
  <p>{{ report.content }}</p>
  <p>既読数：{{ readNum }}</p>
{% for user in readUser %}
  <p>{{ user.name }}</p>
{% endfor %}
  <p>コメント数：{{ commentNum }}</p>
{% for user in comment %}
  <p>{{ user.name }}：{{ user.content }}</p>
{% endfor %}
</div>
