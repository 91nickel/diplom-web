@extends('main')

@section('content')
    <p id="timetable-id" style="display:none;">{{$timetable->id}}</p>
    <p id="user-id" style="display:none;">{{Auth::user()->id}}</p>
    <p id="token" style="display:none;">{{ csrf_field() }}</p>
    <section class="container">
        <div class="row my-4">
            <div class="col-3"><h2>{{$film->name}}</h2></div>
            <div class="col-2"><h2>{{$hall->name}}</h2></div>
            <div class="col"><h2>Начало {{$date}} в {{$time}}</h2></div>
        </div>
        <div id='hall' class="container">
        </div>
    </section>

    <script>
        document.addEventListener('DOMContentLoaded', () => {

            makeRequest().then(parser);

            function parser(data) {
                return new Promise(function (resolve, reject) {
                    const container = $('#hall')[0];
                    container.innerHTML = '';
                    const hall = Array(data.hall.rows).fill([]).map((el, i) => {
                        return Array(data.hall.seats + 1).fill(0).map((el, i) => {
                            return i;
                        });
                    });

                    hall.forEach((el, i) => {
                        container.appendChild(createRow(container, i + 1, data.hall.seats));
                    });

                    for (let i in data.orders) {
                        const rowString = `[data-row="${data.orders[i].row}"]`;
                        const seatString = `[data-seat="${data.orders[i].seat}"]`;
                        const element = document.querySelector(rowString + seatString);
                        outOfOrder(element);
                    }

                    container.appendChild(createSubmitButton(container));

                    resolve();
                });
            }

            function makeRequest() {
                return new Promise(function (resolve, reject) {
                    const id = +$('#timetable-id')[0].innerText;
                    const apiString = `/api/makeOrder/${id}`;
                    const request = new XMLHttpRequest();
                    request.addEventListener('load', () => {
                        resolve(JSON.parse(request.response));
                    });
                    request.open('GET', apiString);
                    request.send();
                });
            }

            function createRowNumber(row) {
                const element = document.createElement('div');
                const innerElement = document.createElement('h4');
                innerElement.innerText = row;
                element.classList.add('col');
                element.appendChild(innerElement);
                return element;
            }

            function createSeat(row, seat) {
                const element = document.createElement('div');
                element.classList.add('col');

                const innerElement = document.createElement('button');
                innerElement.setAttribute('sale', '');
                innerElement.classList.add('btn');
                innerElement.classList.add('btn-info');
                innerElement.classList.add('p-2');
                innerElement.classList.add('waves-effect');
                innerElement.classList.add('waves-light');

                innerElement.addEventListener('click', (event) => {
                    if (!event.target.hasAttribute('out-of-order')) {
                        if (event.target.hasAttribute('sale')) {
                            selectSeat(event.target);
                        }
                    }
                });

                innerElement.dataset.row = row;
                innerElement.dataset.seat = seat;
                innerElement.innerText = seat < 10 ? `0${seat}` : seat;

                element.appendChild(innerElement);

                return element;
            }

            function createRow(container, row, seats) {
                const element = document.createElement('div');
                element.classList.add('row');

                element.appendChild(createRowNumber(row));

                for (let i = 0; i < seats; i++) {
                    element.appendChild(createSeat(row, i + 1));
                }
                return element;
            }

            function selectSeat(element) {
                element.classList.toggle('btn-info');
                element.classList.toggle('btn-warning');
                if (element.hasAttribute('checked')) {
                    element.removeAttribute('checked');
                } else {
                    element.setAttribute('checked', '')
                }
            }

            function outOfOrder(element) {
                element.classList.toggle('btn-info');
                element.classList.toggle('btn-danger');
                element.setAttribute('out-of-order', '');
            }

            function createSubmitButton(container) {
                const row = document.createElement('div');
                row.classList.add('row');

                const button = document.createElement('button');
                button.innerText = 'Забронировать';
                button.classList.add('btn');
                button.classList.add('btn-warning');
                button.classList.add('p-2');
                button.classList.add('waves-effect');
                button.classList.add('waves-light');

                button.addEventListener('click', (event) => {
                    let data = Array.from(container.querySelectorAll('[checked]'));
                    data = data.map((el) => {
                        return {
                            row: el.dataset.row,
                            seat: el.dataset.seat,
                            timetable_id: +$('#timetable-id')[0].innerText,
                            user_id: +$('#user-id')[0].innerText
                        }
                    });
                    data = JSON.stringify(data);

                    let token = document.querySelector('#token').children[0].value;

                    const form = new FormData();
                    form.append('_token', token);
                    form.append('data', data);
                    form.append('timetable_id', $('#timetable-id')[0].innerText);

                    let request = new XMLHttpRequest();
                    request.open('POST', '/api/addOrder');
                    request.send(form);

                    request.addEventListener('load', () => {
                        console.log(request.response);
                        const result = JSON.parse(request.response);
                        console.log(result);
                        parser(result);
                    });
                });

                row.appendChild(button);
                return row
            }
        });
    </script>
@endsection
