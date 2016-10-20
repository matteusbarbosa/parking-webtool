<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<title>Title of the document</title>
	<link rel="stylesheet" type="text/css" href="css/style.css">
	<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
	<script>
	function read(address_request) {
		var xmlhttp = new XMLHttpRequest();

		xmlhttp.onreadystatechange=function() {
			if (xmlhttp.readyState==4 && xmlhttp.status==200) {
				document.getElementById("data-result").innerHTML = xmlhttp.responseText;
			}
		}
		xmlhttp.open("GET", address_request, true);
		xmlhttp.send();
	}

	function list_fill(e, address_request) {
		var xmlhttp = new XMLHttpRequest();

		if(e.options[e.selectedIndex].index !== 0)
		return;

		xmlhttp.onreadystatechange=function() {
			if (xmlhttp.readyState==4 && xmlhttp.status==200) {

				var data_json = JSON.parse(xmlhttp.responseText);

					e.innerHTML = '';

					for(var c = 0; c < data_json.length; c++){
						var text_display = data_json[c].name != null ? data_json[c].name : data_json[c].title;
						e.innerHTML += '<option value="'+data_json[c].id+'">'+text_display+'</option>';
					}

					if(data_json.length == 0)
					e.innerHTML += '<option value="0">Não há itens para exibir</option>';
			}
		}
		xmlhttp.open("GET", address_request, true);
		xmlhttp.send();
	}

	function save(address_request) {
		var xmlhttp = new XMLHttpRequest();

		var myForm = document.getElementById('save-form');
		formData = new FormData(myForm);

		xmlhttp.open("POST", address_request, true);

		//xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
		xmlhttp.onreadystatechange=function() {
			if (xmlhttp.readyState==4 && xmlhttp.status==200) {
				document.getElementById("data-result").innerHTML = xmlhttp.responseText;
			}
		}

		xmlhttp.send(formData);
	}

function update(address_request) {
	var xmlhttp = new XMLHttpRequest();

	var myForm = document.getElementById('manage-form');
	formData = new FormData(myForm);

	xmlhttp.open("POST", address_request, true);

	//xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	xmlhttp.onreadystatechange=function() {
		if (xmlhttp.readyState==4 && xmlhttp.status==200) {
			document.getElementById("data-result").innerHTML = xmlhttp.responseText;
		}
	}

	read(address_request);

	xmlhttp.send(formData);

}

function remove(address_request) {
	var xmlhttp = new XMLHttpRequest();

	var myForm = document.getElementById('manage-form');
	formData = new FormData(myForm);

	xmlhttp.open("DELETE", address_request, true);

	//xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	xmlhttp.onreadystatechange = function() {
		if (xmlhttp.readyState==4 && xmlhttp.status==200) {
			document.getElementById("data-result").innerHTML = xmlhttp.responseText;
		}
	}

	read(address_request);

	xmlhttp.send(formData);

}

function list_fill_trigger(e, address_request, list_target_id) {
	var xmlhttp = new XMLHttpRequest();

	xmlhttp.onreadystatechange=function() {
		if (xmlhttp.readyState==4 && xmlhttp.status==200) {

			var data_json = JSON.parse(xmlhttp.responseText);
			if(data_json != null){
				document.getElementById(list_target_id).innerHTML = '';
			if(data_json.length > 1){
				for(var c = 0; c < data_json.length; c++){
					var text_display = data_json[c].name != null ? data_json[c].name : data_json[c].title;
					document.getElementById(list_target_id).innerHTML += '<option value="'+data_json[c].id+'">'+text_display+'</option>';
				}
			} else {
				document.getElementById(list_target_id).innerHTML += '<option value="'+data_json.id+'">'+data_json.name+'</option>';
			}
		}
		}
	}
	xmlhttp.open("GET", address_request+'/'+e.options[e.selectedIndex].value , true);
	xmlhttp.send();
}

function toggle_field(e, field_id, hide_id) {
	if(document.getElementById(field_id).style.display == "none"){
		document.getElementById(field_id).style.display = "block";
		document.getElementById(hide_id).style.display = "none";
		e.text = "-";
	}
	else{
		document.getElementById(field_id).style.display = "none";
		document.getElementById(hide_id).style.display = "block";
		e.text = "+";
	}
}

function calculate_payment(e, display_id, address_request) {
	var xmlhttp = new XMLHttpRequest();

	xmlhttp.onreadystatechange=function() {
		if (xmlhttp.readyState==4 && xmlhttp.status==200) {

			var data_json = JSON.parse(xmlhttp.responseText);
			if(data_json != null){
				document.getElementById(display_id).value = data_json;
				document.getElementById(display_id+"_wrap").style.display = "block";
		}
		}
	}
	xmlhttp.open("GET", address_request+'/'+e.options[e.selectedIndex].value , true);
	xmlhttp.send();
}

	</script>
</head>

<body>
	<div class="container">
		<div class="row">
			<div class="col-sm-12"><h3>Estacionamento v1.0</h3></div>
		</div>
	<div class="row">
		<div class="col-sm-3" id="sidebar-left"><ul>
			<li><h3>Valor da hora: <span style="color: #63d22c;">R$ <?php echo Payment::PRICE_HOUR; ?></span></h3></li>
			<li><button onclick="read('forms/park_in')" class="btn btn-primary center-block">+ Entrada</button></li>
			<li><button onclick="read('forms/park_out')" class="btn btn-primary center-block">+ Saída</button></li>
			<li><button onclick="read('lists/parkings')" class="btn btn-primary center-block">Listar Estacionados</button></li>
			<li><button onclick="read('lists/clients')" class="btn btn-primary center-block">Listar Clientes</button></li>
			<li><button onclick="read('lists/vehicles')" class="btn btn-primary center-block">Listar Veículos</button></li>
		</ul>
	</div>
		<div class="col-sm-6">
			<div id="data-result"><h3>Bem-vindo</h3>
				<div class="alert alert-info">
					<p>Escolha uma das opções de atendimento disponíveis no menu.</p>
				</div>
			</div>
		</div>
	</div>
	</div>
</body>
</html>
