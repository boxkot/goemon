<div>
{% for val in report %}
  <p>{{ val.created_at }}</p>
  <p>{{ val.title }}</p>
{% endfor %}
</div>
