<div class="col-md-6 col-md-offset-1">
  <table class="table table-hover">
{% for key, report in data %}
    <tr>
      <td>{{ report.name }}</td>
      <td><a href="{{ site_url }}report/view/?id={{ report.id }}">{{ report.title }}</a></td>
      <td>{{ report.read_num }}</td>
      <td>{{ report.comment_num }}</td>
    </tr>
{% endfor %}
  </table>
</div>
