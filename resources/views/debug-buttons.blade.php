<!DOCTYPE html>
<html>
<head>
    <title>Debug Buttons Test</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h1>Debug Buttons Test</h1>
        
        <div class="row">
            <div class="col-6">
                <div class="card">
                    <div class="card-header bg-primary text-white">
                        <h5>Kanji Test</h5>
                    </div>
                    <div class="card-body">
                        <p>Current limit: <span id="kanji-limit">6</span></p>
                        <p>Total: <span id="kanji-total">100</span></p>
                        <button class="btn btn-outline-primary" onclick="testLoadMoreKanji()">
                            <i class="fas fa-plus me-2"></i>Xem thêm Kanji
                        </button>
                    </div>
                </div>
            </div>
            
            <div class="col-6">
                <div class="card">
                    <div class="card-header bg-success text-white">
                        <h5>Vocabulary Test</h5>
                    </div>
                    <div class="card-body">
                        <p>Current limit: <span id="vocab-limit">6</span></p>
                        <p>Total: <span id="vocab-total">200</span></p>
                        <button class="btn btn-outline-success" onclick="testLoadMoreVocabulary()">
                            <i class="fas fa-plus me-2"></i>Xem thêm Vocabulary
                        </button>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="mt-4">
            <h3>Console Log:</h3>
            <div id="console-log" style="background: #f8f9fa; padding: 10px; border-radius: 5px; height: 200px; overflow-y: auto;"></div>
        </div>
    </div>

    <script>
        let kanjiLimit = 6;
        let vocabLimit = 6;
        const totalKanji = 100;
        const totalVocab = 200;
        
        function log(message) {
            const consoleDiv = document.getElementById('console-log');
            const time = new Date().toLocaleTimeString();
            consoleDiv.innerHTML += `[${time}] ${message}<br>`;
            consoleDiv.scrollTop = consoleDiv.scrollHeight;
            console.log(message);
        }
        
        function testLoadMoreKanji() {
            log('testLoadMoreKanji called');
            if (kanjiLimit >= totalKanji) {
                alert('Đã hiển thị tất cả Kanji!');
                return;
            }
            
            const btn = event.target;
            const originalText = btn.innerHTML;
            btn.innerHTML = '<i class="fas fa-spinner fa-spin me-2"></i>Đang tải...';
            btn.disabled = true;
            
            setTimeout(() => {
                kanjiLimit = Math.min(kanjiLimit + 6, totalKanji);
                document.getElementById('kanji-limit').textContent = kanjiLimit;
                btn.innerHTML = originalText;
                btn.disabled = false;
                log(`Kanji limit updated to: ${kanjiLimit}`);
            }, 1000);
        }
        
        function testLoadMoreVocabulary() {
            log('testLoadMoreVocabulary called');
            if (vocabLimit >= totalVocab) {
                alert('Đã hiển thị tất cả từ vựng!');
                return;
            }
            
            const btn = event.target;
            const originalText = btn.innerHTML;
            btn.innerHTML = '<i class="fas fa-spinner fa-spin me-2"></i>Đang tải...';
            btn.disabled = true;
            
            setTimeout(() => {
                vocabLimit = Math.min(vocabLimit + 6, totalVocab);
                document.getElementById('vocab-limit').textContent = vocabLimit;
                btn.innerHTML = originalText;
                btn.disabled = false;
                log(`Vocabulary limit updated to: ${vocabLimit}`);
            }, 1000);
        }
        
        log('Debug page loaded');
    </script>
</body>
</html>
