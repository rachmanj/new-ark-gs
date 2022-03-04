<form action="{{ route('budget.destroy', $model->id) }}" method="POST">
  <a href="{{ route('budget.show', $model->id) }}"><i class="fas fa-search"></i></a>
  @hasanyrole('superadmin|admin_budget')
  @csrf @method('DELETE')
  <a href="{{ route('budget.edit', $model->id) }}" class="btn btn-xs btn-warning"><i class="fas fa-edit"></i></a>
  <button type="submit" class="btn btn-xs btn-danger" onclick="return confirm('Are You sure You want to delete this records?') ">
    <i class="fas fa-trash"></i>
  </button>
  @endhasanyrole
</form>