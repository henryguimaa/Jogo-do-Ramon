@extends('layouts.app')

@section('content')
	<h2>Criar Personagem</h2>

	<div class="form-card">
	<form method="POST" action="{{ route('characters.store') }}">
		@csrf

		<label>Nome<br><input name="name" value="{{ old('name') }}" required></label>

		<label>Raça<br>
			<select name="race" required>
				<option value="">-- selecione --</option>
				@foreach($races as $r)
					<option value="{{ $r }}" @if(old('race') == $r) selected @endif>{{ $r }}</option>
				@endforeach
			</select>
		</label>

		<label>Classe<br>
			<select name="char_class" id="char_class" required>
				<option value="">-- selecione --</option>
				@foreach($classes as $c)
					<option value="{{ $c }}" @if(old('char_class') == $c) selected @endif>{{ $c }}</option>
				@endforeach
			</select>
		</label>

		<label>Subclasse<br>
			<select name="subclass" id="subclass">
				<option value="">-- selecione classe primeiro --</option>
			</select>
		</label>

		<label>Elemento<br>
			<select name="element">
				@foreach($elements as $e)
					<option value="{{ $e }}" @if(old('element', 'neutral') == $e) selected @endif>{{ ucfirst($e) }}</option>
				@endforeach
			</select>
		</label>

		<br>
		<button type="submit" class="btn">Criar</button>
	</form>
	</div>

	<script>
		// map de subclasses vindo do servidor
		const subclasses = @json($subclasses);

		function populateSubclasses(selectedClass, selectedValue = '') {
			const subSelect = document.getElementById('subclass');
			subSelect.innerHTML = '';
			if (!selectedClass || !subclasses[selectedClass]) {
				let opt = document.createElement('option');
				opt.value = '';
				opt.text = '-- selecione classe primeiro --';
				subSelect.appendChild(opt);
				return;
			}
			let optEmpty = document.createElement('option');
			optEmpty.value = '';
			optEmpty.text = '-- nenhuma --';
			subSelect.appendChild(optEmpty);
			subclasses[selectedClass].forEach(function(s){
				let opt = document.createElement('option');
				opt.value = s;
				opt.text = s;
				if (s === selectedValue) opt.selected = true;
				subSelect.appendChild(opt);
			});
		}

		document.getElementById('char_class').addEventListener('change', function(){
			populateSubclasses(this.value);
		});

		// se houver valor antigo preencher
		(function(){
			const oldClass = "{{ old('char_class','') }}";
			const oldSub = "{{ old('subclass','') }}";
			if (oldClass) {
				document.getElementById('char_class').value = oldClass;
				populateSubclasses(oldClass, oldSub);
			}
		})();
	</script>
@endsection
