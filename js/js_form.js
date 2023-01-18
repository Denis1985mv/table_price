
function makeTable(list){
	const table = document.getElementById('mainTable');
	table.innerHTML ='' 
	const firstTR = document.createElement('tr');

	for (let key in list[0]){
		if(list[0].hasOwnProperty(key) && key.toString().toLowerCase() !== 'id'){
			const th = document.createElement('th');
			th.innerHTML = key;
			firstTR.appendChild(th);
		}
	}
	table.appendChild(firstTR);
	list.forEach((row, i) => {
		const tr = document.createElement('tr');
		for (let key in row){
			if(row.hasOwnProperty(key) && key.toString().toLowerCase() !== 'id'){
				const td = document.createElement('td');
				td.innerHTML = row[key];
				tr.appendChild(td);
				
			}
			
		}


		table.appendChild(tr);
	});

}



document.addEventListener('DOMContentLoaded', () => { 
	const searchType1 = document.getElementById('searchType1');
	const searchFrom = document.getElementById('searchFrom');
	const searchTo = document.getElementById('searchTo');
	const searchType2 = document.getElementById('searchType2');
	const search2Count = document.getElementById('search2Count');
	const button = document.getElementById('searchButton');

	button.addEventListener('click', (event) =>{
		event.stopPropagation();
		event.preventDefault();

		if(parseInt(searchFrom.value) >= parseInt(searchTo.value)){
			alert('задан неверный критерий поиска');
			return;
		}

		const url = `http://j29274lh.beget.tech/task_two.php?type1=${searchType1.value}&from=${searchFrom.value}&to=${searchTo.value}&type2=${searchType2.value}&count=${search2Count.value}`;
		fetch(url,{
	    			method: 'GET',
	    			headers: {
	      			'Content-Type': 'application/json'
	    			},
	  	}).then(response => response.json())
	  	.then((res) => {
	  		console.log(res); 
	  		makeTable(res.list);
	  	});

	});
});