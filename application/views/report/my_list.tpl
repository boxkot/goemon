<div>
{% for report in data %}
  <p>{{ report.created_at }}</p>
  <td><a href="{{ site_url }}report/view/?id={{ report.id }}">{{ report.title }}</a></td>
{% endfor %}
</div>
