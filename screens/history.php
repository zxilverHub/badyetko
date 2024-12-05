<div class="history-section">
    <div class="history-menu">

        <p>My history</p>

        <button class="delete-button">Delete</button>
    </div>
    <div class="history-header">
        <p>Title</p>
        <p>Amount</p>
        <p>Start</p>
        <p>End</p>
        <p>Savings</p>
    </div>

    <script>
        $(".history-card").click((e) => {
            console.log('hello')
            $("#main-section").load("./historycontent.php")
        })
    </script>

    <div class="histories">

        <!-- CARDS -->
        <div class="history-card" id="h1">
            <p class="title">This is title</p>
            <p class="amount">P2000</p>
            <p class="start">November 1, 2024</p>
            <p class="end">November 5, 2024</p>
            <p class="saving">P100</p>
            <input type="checkbox" class="check-delete">
        </div>

        <div class="history-card" id="h1">
            <p class="title">This is title</p>
            <p class="amount">P2000</p>
            <p class="start">November 1, 2024</p>
            <p class="end">November 5, 2024</p>
            <p class="saving">P100</p>
            <input type="checkbox" class="check-delete">
        </div>

        <div class="history-card" id="h1">
            <p class="title">This is title</p>
            <p class="amount">P2000</p>
            <p class="start">November 1, 2024</p>
            <p class="end">November 5, 2024</p>
            <p class="saving">P100</p>
            <input type="checkbox" class="check-delete">
        </div>

        <div class="history-card" id="h1">
            <p class="title">This is title</p>
            <p class="amount">P2000</p>
            <p class="start">November 1, 2024</p>
            <p class="end">November 5, 2024</p>
            <p class="saving">P100</p>
            <input type="checkbox" class="check-delete">
        </div>

        <div class="history-card" id="h1">
            <p class="title">This is title</p>
            <p class="amount">P2000</p>
            <p class="start">November 1, 2024</p>
            <p class="end">November 5, 2024</p>
            <p class="saving">P100</p>
            <input type="checkbox" class="check-delete">
        </div>

        <div class="history-card" id="h1">
            <p class="title">This is title</p>
            <p class="amount">P2000</p>
            <p class="start">November 1, 2024</p>
            <p class="end">November 5, 2024</p>
            <p class="saving">P100</p>
            <input type="checkbox" class="check-delete">
        </div>



    </div>
</div>