@csrf
<div class="card m-auto" style="width: 30rem;display:flex;
    flex-direction:column; align-items:center">
    
    <div class="card-body w-100 create_edit_form" style="align-items:left">
        @if ($element) 
        <h4 class="card-title">Редактирование заявки</h4>
        <p class="text-start  font-monospace m-0"> Заявка: № {{ $element->id }}</p>
        <p class="text-start  font-monospace m-0"> Создана: {{ $element->created_at}}</p>
        <p class="text-start  font-monospace m-0"> Обновлена: {{ $element->updated_at}}</p>
        <p class="text-start  font-monospace m-0"> Статус: {{ $element->status }}</p>
        <p class="text-start  font-monospace m-0"> Автор: {{ $element->user_name }}</p>
        @if($managers)
        <div class="mb-3 d-flex align-items-center justify-content-between">
            <label for="metal" class="form-label p-2 m-0">Менеджер</label>
            <div class="input-group has-validation">
                <select class="form-control @error('manager') is-invalid
                    @enderror" name="manager" id="manager" required>
                    <option value="">Выберите Менеджера</option>
                    @foreach ($managers as $item)
                    <option value="{{$item->id}}" <?= $element->manager_id ==
                            $item->id ? 'selected="selected"' : ''; ?>>{{$item->name}}</option>
                        @endforeach
                 </select>
                @error('manager')
                <div class="invalid-feedback">{{$message}}</div>
                @enderror
            </div>
        </div>    
        @else
        <p class="text-start  font-monospace m-0"> Менеджер: {{ $element->manager_name }}</p>
        @endif
        @else
        <h4 class="card-title">Новая заявка</h4>
        @endif
          <div class="mb-3 d-flex align-items-center justify-content-between">
              <label for="message" class="form-label p-2 m-0">Заявка</label>
                <div class="input-group has-validation">
                    <textarea name="message" id="message" rows="7" class="form-control @error('message') is-invalid @enderror">{{old('message') ?? $element->message ?? ''}}</textarea>
                    @error('message')
                    <div class="invalid-feedback">{{$message}}</div>
                    @enderror
                </div>
           </div>
           @if (Auth::user()->is_User())
           @if ($element)
           <p class="text-start  font-monospace m-0"> Ответ : {{ $element->comment }}</p> 
           @endif
              
           @else
           <div class="mb-3 d-flex align-items-center justify-content-between">
                <label for="message" class="form-label p-2 m-0">Комментарий</label>
                <div class="input-group">
                    <textarea name="comment" id="comment" rows="7" class="form-control @error('comment') is-invalid @enderror">{{old('comment') ?? $element->comment ?? ''}}</textarea>
                </div>
           </div>
           @endif

            <a href="{{ route('orders.index')}}" class="btn btn-outline-success
                btn-sm">К заявкам</a>

            @if ((Auth::user()->is_User() AND  (!$element OR $element->status !== 'Resolved')) OR ( Auth::user()->is_Admin() OR Auth::user()->is_Manager() ))
                <button type="submit" class="btn btn-outline-primary btn-sm">Сохранить</button>    
            @endif
            
        </div>
    </div>