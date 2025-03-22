<!DOCTYPE html>
<html lang="zh-TW">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FIRE 退休計算機</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body class="bg-gray-50 text-gray-800">
    <div class="container mx-auto px-4 py-8 max-w-4xl">
        <header class="text-center mb-6">
            <h1 class="text-3xl md:text-4xl font-bold text-indigo-600 mb-3">FIRE 退休計算機</h1>
            <p class="text-lg text-gray-600">財務獨立、提早退休 (Financial Independence, Retire Early)</p>
        </header>
        
        <!-- 說明區塊 - 可折疊 -->
        <div class="bg-white rounded-lg shadow-md p-4 mb-8">
            <div class="flex justify-between items-center cursor-pointer" onclick="toggleExplanation()">
                <h2 class="text-xl font-semibold text-indigo-600">計算機說明</h2>
                <button id="explanationToggle" class="text-gray-500 hover:text-indigo-600">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                    </svg>
                </button>
            </div>
            
            <div id="explanationContent" class="mt-3 hidden">
                <p class="text-gray-700 mb-2">FIRE (Financial Independence, Retire Early)，意即「財務獨立、提早退休」是一種理財觀念，認為只要存夠了錢，透過投資的複利提領固定比例的金額當生活費用，就可以達到提早退休的目的。</p>
                
                <h3 class="font-medium text-indigo-600 mt-4 mb-1">提早退休的條件</h3>
                <p class="text-gray-700 mb-2">如果您一年的支出為 50 萬，提領率為 4%，代表需要有 1250 萬的資產 (1250 * 4% = 50)，這 1250萬稱為「FIRE資產淨額」。當總資產淨額超過 FIRE 資產淨額，則代表達到提早退休的條件。</p>
                
                <h3 class="font-medium text-indigo-600 mt-4 mb-1">相關參數說明</h3>
                <ul class="list-disc list-inside text-gray-700 mb-2 space-y-1">
                    <li><span class="font-medium">提領率</span>：常見用 4%，保守者可降低一點，一般建議提領率要略低於投資報酬率減通貨膨帳率</li>
                    <li><span class="font-medium">年支出</span>：年支出愈大代表需要愈多的 FIRE 資產淨額</li>
                    <li><span class="font-medium">通貨膨帳率</span>：一般用 2%~3%，可參考台灣歷年消費者物價指數年增率</li>
                    <li><span class="font-medium">投資報酬率</span>：視每個投資者狀況不同，通常設定為 5%~8%</li>
                </ul>
            </div>
        </div>
        
        <div class="grid md:grid-cols-2 gap-8">
            <!-- 輸入區塊 -->
            <div class="bg-white rounded-lg shadow-md p-6">
                <h2 class="text-xl font-semibold mb-6 text-indigo-600 border-b pb-2">個人資料輸入</h2>
                
                <div class="space-y-4">
                    <div>
                        <label for="age" class="block text-sm font-medium text-gray-700 mb-1">目前年齡</label>
                        <input type="number" id="age" min="18" max="80" value="30" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500">
                    </div>
                    
                    <div>
                        <label for="expenses" class="block text-sm font-medium text-gray-700 mb-1">年支出 (萬元)</label>
                        <input type="number" id="expenses" min="10" value="50" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500">
                    </div>
                    
                    <div>
                        <label for="savings" class="block text-sm font-medium text-gray-700 mb-1">年儲蓄 (萬元)</label>
                        <input type="number" id="savings" min="0" value="20" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500">
                    </div>
                    
                    <div>
                        <label for="netWorth" class="block text-sm font-medium text-gray-700 mb-1">現在資產淨額 (萬元)</label>
                        <input type="number" id="netWorth" min="0" value="100" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500">
                    </div>
                </div>
                
                <h2 class="text-xl font-semibold my-6 text-indigo-600 border-b pb-2">財務參數設定</h2>
                
                <div class="space-y-4">
                    <div>
                        <label for="withdrawalRate" class="block text-sm font-medium text-gray-700 mb-1">
                            提領率 (%)
                            <span class="text-xs text-gray-500 ml-1 cursor-help" title="每年從資產中提取的百分比，常見為4%">ⓘ</span>
                        </label>
                        <input type="number" id="withdrawalRate" min="1" max="10" step="0.1" value="4" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500">
                    </div>
                    
                    <div>
                        <label for="roi" class="block text-sm font-medium text-gray-700 mb-1">
                            投資報酬率 (%)
                            <span class="text-xs text-gray-500 ml-1 cursor-help" title="預期年化投資回報率">ⓘ</span>
                        </label>
                        <input type="number" id="roi" min="1" max="15" step="0.1" value="6" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500">
                    </div>
                    
                    <div>
                        <label for="inflation" class="block text-sm font-medium text-gray-700 mb-1">
                            通貨膨脹率 (%)
                            <span class="text-xs text-gray-500 ml-1 cursor-help" title="預期年通脹率，通常介於2-3%">ⓘ</span>
                        </label>
                        <input type="number" id="inflation" min="0" max="10" step="0.1" value="2" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500">
                    </div>
                </div>
            </div>
            
            <!-- 結果顯示區塊 -->
            <div class="bg-white rounded-lg shadow-md p-6">
                <h2 class="text-xl font-semibold mb-6 text-indigo-600 border-b pb-2">FIRE 退休分析</h2>
                
                <div class="space-y-6">
                    <div class="p-4 bg-indigo-50 rounded-lg">
                        <h3 class="font-medium text-indigo-700 mb-2">FIRE 目標</h3>
                        <div class="grid grid-cols-2 gap-4 text-sm">
                            <div>
                                <p class="text-gray-600">所需FIRE資產:</p>
                                <p class="text-2xl font-bold text-indigo-600" id="fireAmount">1,250萬元</p>
                            </div>
                            <div>
                                <p class="text-gray-600">預計達成年齡:</p>
                                <p class="text-2xl font-bold text-indigo-600" id="retireAge">45歲</p>
                            </div>
                        </div>
                    </div>
                    
                    <div>
                        <h3 class="font-medium text-gray-700 mb-3">退休進度</h3>
                        <div class="relative pt-1">
                            <div class="flex mb-2 items-center justify-between">
                                <div>
                                    <span class="text-xs font-semibold inline-block py-1 px-2 uppercase rounded-full text-indigo-600 bg-indigo-200">
                                        進度: <span id="progressPercent">8%</span>
                                    </span>
                                </div>
                                <div class="text-right">
                                    <span class="text-xs font-semibold inline-block text-indigo-600">
                                        <span id="currentAmount">100萬</span> / <span id="targetAmount">1,250萬</span>
                                    </span>
                                </div>
                            </div>
                            <div class="overflow-hidden h-2 mb-4 text-xs flex rounded bg-indigo-200">
                                <div id="progressBar" style="width:8%" class="shadow-none flex flex-col text-center whitespace-nowrap text-white justify-center bg-indigo-500"></div>
                            </div>
                        </div>
                    </div>
                    
                    <div>
                        <h3 class="font-medium text-gray-700 mb-3">資產成長預測</h3>
                        <canvas id="growthChart" width="400" height="200"></canvas>
                    </div>
                    
                    <div class="bg-green-50 p-4 rounded-lg mt-6" id="recommendationBox">
                        <h3 class="font-medium text-green-700 mb-2">分析建議</h3>
                        <p class="text-sm text-green-600">
                            根據您的輸入，您有望在<span id="recommendAge">45</span>歲達成FIRE目標，比法定退休年齡提前<span id="yearsEarly">20</span>年！
                            為了加速達成目標，您可以考慮增加年儲蓄或尋求提高投資報酬率的策略。
                        </p>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- 詳細資產成長表格 -->
        <div class="mt-12 bg-white rounded-lg shadow-md p-6 overflow-auto">
            <h2 class="text-xl font-semibold mb-6 text-indigo-600 border-b pb-2">年度資產成長預測</h2>
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">年齡</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">年度</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">資產淨額</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">與FIRE目標比例</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">狀態</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200" id="assetGrowthTable">
                    <!-- 這部分將由JavaScript動態生成 -->
                </tbody>
            </table>
        </div>
        
        <footer class="mt-12 text-center text-sm text-gray-500">
            <p>FIRE退休計算機 &copy; 2023 - 僅供參考，不構成投資建議</p>
            <p class="mt-2">基於4%提領率法則，實際情況可能因個人投資策略與經濟環境而異</p>
        </footer>
    </div>

    <script>
        // 折疊/展開說明區塊的功能
        function toggleExplanation() {
            const content = document.getElementById('explanationContent');
            const toggle = document.getElementById('explanationToggle');
            
            if (content.classList.contains('hidden')) {
                content.classList.remove('hidden');
                toggle.innerHTML = `<svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 15l7-7 7 7" />
                </svg>`;
            } else {
                content.classList.add('hidden');
                toggle.innerHTML = `<svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                </svg>`;
            }
        }

        // 初始化圖表
        const ctx = document.getElementById('growthChart').getContext('2d');
        const growthChart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: ['30歲', '35歲', '40歲', '45歲', '50歲', '55歲', '60歲', '65歲'],
                datasets: [{
                    label: '資產淨額 (萬元)',
                    data: [100, 321, 624, 1250, 1900, 2600, 3500, 4500],
                    borderColor: 'rgb(79, 70, 229)',
                    backgroundColor: 'rgba(79, 70, 229, 0.1)',
                    fill: true,
                    tension: 0.4
                },
                {
                    label: 'FIRE目標 (萬元)',
                    data: [1250, 1250, 1250, 1250, 1250, 1250, 1250, 1250],
                    borderColor: 'rgb(239, 68, 68)',
                    backgroundColor: 'rgba(239, 68, 68, 0.1)',
                    borderDash: [5, 5],
                    fill: false
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    tooltip: {
                        mode: 'index',
                        intersect: false,
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        title: {
                            display: true,
                            text: '萬元'
                        }
                    }
                }
            }
        });

        // 在這裡添加計算邏輯的JavaScript代碼
        function calculateFIRE() {
            // 獲取用戶輸入
            const age = parseInt(document.getElementById('age').value);
            const expenses = parseInt(document.getElementById('expenses').value);
            const savings = parseInt(document.getElementById('savings').value);
            const netWorth = parseInt(document.getElementById('netWorth').value);
            const withdrawalRate = parseFloat(document.getElementById('withdrawalRate').value) / 100;
            const roi = parseFloat(document.getElementById('roi').value) / 100;
            const inflation = parseFloat(document.getElementById('inflation').value) / 100;
            
            // 計算FIRE所需資產
            const fireAmount = Math.round(expenses / withdrawalRate);
            
            // 更新顯示
            document.getElementById('fireAmount').textContent = fireAmount.toLocaleString() + '萬元';
            document.getElementById('targetAmount').textContent = fireAmount.toLocaleString() + '萬';
            document.getElementById('currentAmount').textContent = netWorth.toLocaleString() + '萬';
            
            // 計算達成FIRE的年齡 (簡化計算，實際應考慮通脹等因素)
            let currentAge = age;
            let currentNetWorth = netWorth;
            let years = 0;
            let retireAge = 0;
            let isRetired = false;
            
            // 用於存儲年度預測數據的陣列
            const yearlyData = [];
            const currentYear = new Date().getFullYear();
            
            // 模擬資產成長直到退休後20年
            while (currentAge < 100) {
                // 添加本年度數據
                const percentOfTarget = Math.min(100, Math.round((currentNetWorth / fireAmount) * 100));
                yearlyData.push({
                    age: currentAge,
                    year: currentYear + (currentAge - age),
                    netWorth: currentNetWorth,
                    percent: percentOfTarget,
                    retired: isRetired
                });
                
                // 更新退休狀態
                if (!isRetired && currentNetWorth >= fireAmount) {
                    isRetired = true;
                    retireAge = currentAge;
                }
                
                // 資產成長邏輯
                if (!isRetired) {
                    // 退休前：資產增長 + 儲蓄
                    currentNetWorth = currentNetWorth * (1 + roi) + savings;
                } else {
                    // 退休後：資產增長 - 提領
                    currentNetWorth = currentNetWorth * (1 + roi) - expenses;
                }
                
                currentAge++;
                years++;
                
                // 如果已經退休並且已經過了退休後20年，則停止
                if (isRetired && currentAge > retireAge + 20) {
                    break;
                }
            }
            
            // 更新結果顯示
            if (isRetired) {
                document.getElementById('retireAge').textContent = retireAge + '歲';
                document.getElementById('recommendAge').textContent = retireAge;
                document.getElementById('yearsEarly').textContent = 65 - retireAge;
            } else {
                document.getElementById('retireAge').textContent = '100+歲';
                document.getElementById('recommendAge').textContent = '100+';
                document.getElementById('yearsEarly').textContent = '無法';
            }
            
            // 更新進度條
            const progressPercent = Math.min(100, Math.round((netWorth / fireAmount) * 100));
            document.getElementById('progressPercent').textContent = progressPercent + '%';
            document.getElementById('progressBar').style.width = progressPercent + '%';
            
            // 更新年度資產成長表格
            updateAssetGrowthTable(yearlyData);
            
            // 更新圖表
            updateGrowthChart(yearlyData, fireAmount);
        }
        
        // 新增函數：更新年度資產成長表格
        function updateAssetGrowthTable(yearlyData) {
            const tableBody = document.getElementById('assetGrowthTable');
            tableBody.innerHTML = '';
            
            yearlyData.forEach(data => {
                const row = document.createElement('tr');
                
                // 根據是否已退休設定不同的樣式
                if (data.retired) {
                    row.classList.add('bg-green-50');
                }
                
                row.innerHTML = `
                    <td class="px-6 py-4 whitespace-nowrap">${data.age}</td>
                    <td class="px-6 py-4 whitespace-nowrap">${data.year}</td>
                    <td class="px-6 py-4 whitespace-nowrap">${Math.round(data.netWorth).toLocaleString()}萬元</td>
                    <td class="px-6 py-4 whitespace-nowrap">${data.percent}%</td>
                    <td class="px-6 py-4 whitespace-nowrap">${data.retired ? '已退休' : '積累中'}</td>
                `;
                
                tableBody.appendChild(row);
            });
        }
        
        // 新增函數：更新成長圖表
        function updateGrowthChart(yearlyData, fireAmount) {
            // 準備圖表數據
            const ages = yearlyData.map(data => `${data.age}歲`);
            const netWorth = yearlyData.map(data => Math.round(data.netWorth));
            const targetLine = yearlyData.map(() => fireAmount);
            
            // 更新圖表
            growthChart.data.labels = ages;
            growthChart.data.datasets[0].data = netWorth;
            growthChart.data.datasets[1].data = targetLine;
            growthChart.update();
        }
        
        // 監聽所有輸入欄位變更
        document.querySelectorAll('input').forEach(input => {
            input.addEventListener('change', calculateFIRE);
            input.addEventListener('input', calculateFIRE);
        });
        
        // 頁面載入時執行初始計算
        window.addEventListener('load', calculateFIRE);
    </script>
</body>
</html>
