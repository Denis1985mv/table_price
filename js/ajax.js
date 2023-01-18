

 //            document.getElementById("btnGet").onclick = function () {
 //
  //               var xhr = new XMLHttpRequest();          // Создание объекта для HTTP запроса.
 //               xhr.open("GET", "http://j29274lh.beget.tech/task_two.php?type1=${searchType1.value}&from=${searchFrom.value}&to=${searchTo.value}&type2=${searchType2.value}&count=${search2Count.value}", false); // Настройка объекта для отправки синхронного GET запроса
 //               xhr.send();                              // Отправка запроса, так как запрос является синхронным, следующая строка кода выполнится только после получения ответа со стороны сервера.
 //           }
 //       }
        
//             window.onload = function () {

//            document.getElementById("btnGet").onclick = function () {

//                var xhr = new XMLHttpRequest();          // Создание объекта для HTTP запроса.
 //               xhr.open("GET", "http://j29274lh.beget.tech/task_two.php?type1=${searchType1.value}&from=${searchFrom.value}&to=${searchTo.value}&type2=${searchType2.value}&count=${search2Count.value}", false);", true);  // Настройка объекта для отправки асинхронного GET запроса

                // функция-обработчик срабатывает при изменении свойства readyState
                // Значения свойства readyState:
                // 0 - Метод open() еще не вызывался
                // 1 - Метод open() уже был вызван, но метод send() еще не вызывался.
                // 2 - Метод send() был вызван, но ответ от сервера еще не получен
                // 3 - Идет прием данных от сервера. Для значения 3 Firefox вызывает обработчик события несколько раз IE только один раз.
                // 4 - Ответ от сервера полностью получен (Запрос успешно завершен).

 //               xhr.onreadystatechange = function () {
//                    if (xhr.readyState == 4) { // если получен ответ
 //                       if (xhr.status == 200) { // и если статус код ответа 200
  //                          document.getElementById("output").innerHTML += xhr.responseText; // responseText - текст ответа полученного с сервера.
  //                      }
  //                  }
//                }
                
 //               xhr.send();                              // Отправка запроса, так как запрос асинхронный сценарий продолжит свое выполнение. Когда с сервера придет ответ сработает событие onreadystatechange
 //           }
  //      }
  

  
//  	button.addEventListener('click', (event) =>{
//		event.stopPropagation();
//		event.preventDefault();



  
        
     //     window.onload = function () {
    //        var xhr = new XMLHttpRequest();
            
     //       	const searchType1 = "single";
     //       	const searchFrom = 1000;
     //       	const searchTo = 3000;
     //       	const searchType2 = "more";
      //      	const search2Count = 25;
     //       	const button = document.getElementById('searchButton');
            	
            	

    //        document.getElementById("buttonGet").onclick = function () {
    //            xhr.open("GET", "http://j29274lh.beget.tech/task_two.php?type1=${searchType1.value}&from=${searchFrom.value}&to=${searchTo.value}&type2=${searchType2.value}&count=${search2Count.value}");
    //            xhr.onreadystatechange = function () {
   //                 if (xhr.readyState == 4 && xhr.status == 200) {
                        // JSON.parse - преобразование в объект строки полученной с сервера.
   //                     var myArr = JSON.parse(xhr.responseText);
  //                     document.getElementById("output").innerHTML = myArr[0];
  //                  }
  //              }
 //               xhr.send();
                
 //           }
 //      }
        
//  }

 //alert(data);





//printList(list);



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
	  	.then(res => {
           console.log(res);
           //alert(res);
	  		makeTable(res.list);
	  		//alert(res);
	  	});

	});
});