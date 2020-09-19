<!DOCTYPE html>
<html lang="en">
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tic Tac ToE</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</head>
<style>
    .center {

        text-align: center;

    }

    .box-item {
        padding: 50px;
        background-color: #F0FFFF;
        border-style: solid;
        border-color: gray;
    }


    .box:hover {
        background-color: #C2B6FF;
    }

    .grid-container {
        display: inline-grid;
        grid-template-columns: auto auto auto;
    }
  
</style>

<body style='background-color: #121212'>
    <div class="my-4 container">
        <div class='center'>
            <div class="card">
                <div class="card-header">
                    <div id='php'></div>
                    <h1><b>Tic Tac ToE</b></h1>
                    <div> <label for="num">กรอกจำนวน</label>
                        <input name='num' id='num' type="number">
                    </div>
                </div>
            </div>
            <div class="card-body">
                <h2 id='player'></h2>
                <div class="grid-container"></div>
            </div>
            <br>
          
        </div>
    </div>

</body>


<script>
    $(document).ready(() => {
        let player = 'O'
        let gridContainer = document.querySelector('.grid-container')
        let data = '';
        let check
        var res
        inputNum = document.querySelector('#num')

        $('#num').change(() => {
           $('.card-body').css("background-color", " #A8A8A8");
            res = null
            var board = new Array(parseInt($('#num').val()));
            console.log(board);
            for (var i = 0; i < board.length; i++) {
                board[i] = new Array(parseInt($('#num').val()));
            }
            player = 'O'
            gridContainer.innerHTML = ''
            $('#player').text(`ตาผู้เล่น : X`)

            for (let i = 0; i < $('#num').val(); i++) {
                data += 'auto ';
                check = (i + 1) * $('#num').val();
            }
            gridContainer.style.gridTemplateColumns = data;
            for (let i = 0; i < check; i++) {
                gridContainer.insertAdjacentHTML('beforeend', ` <div class='box box-item' id='${i}' value='${i+1}'  ></div>`);
            }
            data = '';
            let box = document.querySelectorAll('.box')
            box.forEach(b => {

                b.addEventListener('click', () => {
                    if (res) {
                        return
                    }
                    let column = (b.id % (parseInt($('#num').val())));
                    let row = parseInt(b.id / ($('#num').val()))
                    if (board[row][column] != null) {
                        return
                    }
                    board[row][column] = player

                    $.ajax({
                        url: 'control.php',
                        method: 'POST',
                        data: {
                            player: player,
                            table: $('#num').val(),
                            board: board
                        },
                        success: (result) => {

                            if (result.Winner) {
                                res = result
                                $('#player').text(`Player : ${result.Winner}`)
                            }

                        }
                    })

                    $('#player').text(`ตาผู้เล่น : ${player}`)
                    b.innerText = player
                    b.style.background = '#D58BFF';
                    switchUser(player)

                })
            })
        })
        let switchUser = (now) => {
            if (now == 'O') {
                player = 'X'
            } else {
                player = 'O'
            }
            return player

        }
    })
</script>


</html>