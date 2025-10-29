@extends('layouts.app')

@section('content')
	<h2>Editar Personagem — {{ $character->name }}</h2>

	<div class="form-card">
	<form method="POST" action="{{ route('characters.update', $character->id) }}">
		@csrf
		@method('PUT')

		<label>Nome<br><input name="name" value="{{ old('name', $character->name) }}" required></label>

		<label>Raça<br>
			<select name="race" required>
				<option value="">-- selecione --</option>
				@foreach($races as $r)
					<option value="{{ $r }}" @if(old('race', $character->race) == $r) selected @endif>{{ $r }}</option>
				@endforeach
			</select>
		</label>

		<label>Classe<br>
			<select name="char_class" id="char_class" required>
				<option value="">-- selecione --</option>
				@foreach($classes as $c)
					<option value="{{ $c }}" @if(old('char_class', $character->char_class) == $c) selected @endif>{{ $c }}</option>
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
					<option value="{{ $e }}" @if(old('element', $character->element) == $e) selected @endif>{{ ucfirst($e) }}</option>
				@endforeach
			</select>
		</label>

		<br>
		<button type="submit" class="btn">Salvar</button>
	</form>
	</div>

	<script>
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

		(function(){
			const currentClass = "{{ old('char_class', $character->char_class) }}";
			const currentSub = "{{ old('subclass', $character->subclass) }}";
			if (currentClass) {
				document.getElementById('char_class').value = currentClass;
				populateSubclasses(currentClass, currentSub);
			}
		})();
	</script>
@endsection
