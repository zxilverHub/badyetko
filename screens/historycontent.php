<script>
    $("#backbutton").click((e) => {
        $("#main-section").load("./history.php")
    })
</script>

<div class="history-content-section">
    <div class="history-menu">
        <button id="backbutton">
            <img src="../assets/icons/arrowback.png" alt="">
            Back
        </button>

        <p>My history</p>

        <button class="delete-button">Delete</button>
    </div>

    <div class="main-content">
        <div class="content">
            <h2>Budget categories</h2>

            <div class="content-cards">
                <div class="content-card">
                    <p class="amount">P5000</p>
                    <p class="label">Amount</p>
                </div>

                <div class="content-card">
                    <p class="amount">P3000</p>
                    <p class="label">Meals</p>
                </div>

                <div class="content-card">
                    <p class="amount">P500</p>
                    <p class="label">Transporation</p>
                </div>

                <div class="content-card">
                    <p class="amount">P1000</p>
                    <p class="label">Others</p>
                </div>
            </div>
        </div>

        <div class="expenses-content">
            <h2>Expenses log</h2>

            <div class="expenses-cards">
                <div class="card">
                    <div class="heading">
                        <p class="title">Expenses type</p>
                        <p class="date">November 1, 2024</p>
                    </div>
                    <p class="amount">P100</p>
                </div>

                <div class="card">
                    <div class="heading">
                        <p class="title">Expenses type</p>
                        <p class="date">November 1, 2024</p>
                    </div>
                    <p class="amount">P100</p>
                </div>

                <div class="card">
                    <div class="heading">
                        <p class="title">Expenses type</p>
                        <p class="date">November 1, 2024</p>
                    </div>
                    <p class="amount">P100</p>
                </div>

                <div class="card">
                    <div class="heading">
                        <p class="title">Expenses type</p>
                        <p class="date">November 1, 2024</p>
                    </div>
                    <p class="amount">P100</p>
                </div>

                <div class="card">
                    <div class="heading">
                        <p class="title">Expenses type</p>
                        <p class="date">November 1, 2024</p>
                    </div>
                    <p class="amount">P100</p>
                </div>

                <div class="card">
                    <div class="heading">
                        <p class="title">Expenses type</p>
                        <p class="date">November 1, 2024</p>
                    </div>
                    <p class="amount">P100</p>
                </div>
            </div>
        </div>
    </div>
</div>