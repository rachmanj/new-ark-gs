<form action="{{ route('budget_type.destroy', $model->id) }}">
  <a href="{{ route('budget_type.edit', $model->id) }}" class="btn btn-xs btn-warning"><i class="fas fa-edit"></i></a>
  <button type="submit" class="btn btn-xs btn-danger" onclick="return confirm('Are You sure You want to delete this records?') ">
    <i class="fas fa-trash"></i>
  </button>
</form>