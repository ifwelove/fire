<!DOCTYPE html>
<html lang="zh-TW">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>財務計算工具</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    
    <script>
        // 定義基本函數，解決"未定義"錯誤
        function switchTab(tab) {
            const fireCal = document.getElementById('fireCalculator');
            const compoundCal = document.getElementById('compoundCalculator');
            const fireTab = document.getElementById('fireTab');
            const compoundTab = document.getElementById('compoundTab');
            
            if (tab === 'fire') {
                fireCal.classList.remove('hidden');
                compoundCal.classList.add('hidden');
                fireTab.classList.add('text-indigo-600', 'border-b-2', 'border-indigo-600');
                fireTab.classList.remove('text-gray-500');
                compoundTab.classList.remove('text-indigo-600', 'border-b-2', 'border-indigo-600');
                compoundTab.classList.add('text-gray-500');
            } else {
                fireCal.classList.add('hidden');
                compoundCal.classList.remove('hidden');
                fireTab.classList.remove('text-indigo-600', 'border-b-2', 'border-indigo-600');
                fireTab.classList.add('text-gray-500');
                compoundTab.classList.add('text-indigo-600', 'border-b-2', 'border-indigo-600');
                compoundTab.classList.remove('text-gray-500');
            }
        }
        
        function toggleExplanation(type) {
            const content = document.getElementById(type + 'Content');
            const toggle = document.getElementById(type + 'Toggle');
            
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
    </script>
</head>
<body class="bg-gray-50 text-gray-800">
    <div class="container mx-auto px-4 py-8 max-w-4xl">
        <header class="text-center mb-6">
            <h1 class="text-3xl md:text-4xl font-bold text-indigo-600 mb-3">財務計算工具</h1>
            <p class="text-lg text-gray-600">規劃您的財務未來</p>
        </header>
        
        <!-- 頁面選項卡 -->
        <div class="flex border-b border-gray-200 mb-8">
            <button id="fireTab" class="py-2 px-4 text-indigo-600 border-b-2 border-indigo-600 font-medium" onclick="switchTab('fire')">
                FIRE 退休計算機
            </button>
            <button id="compoundTab" class="py-2 px-4 text-gray-500 hover:text-indigo-600 font-medium" onclick="switchTab('compound')">
                複利計算機
            </button>
        </div>
        
        <!-- FIRE 退休計算機 -->
        <div id="fireCalculator" class="calculator-content">
            <!-- 說明區塊 - 可折疊 -->
            <div class="bg-white rounded-lg shadow-md p-4 mb-8">
                <div class="flex justify-between items-center cursor-pointer" onclick="toggleExplanation('fireExplanation')">
                    <h2 class="text-xl font-semibold text-indigo-600">計算機說明</h2>
                    <button id="fireExplanationToggle" class="text-gray-500 hover:text-indigo-600">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                        </svg>
                    </button>
                </div>
                
                <div id="fireExplanationContent" class="mt-3 hidden">
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
        </div>
        
        <!-- 複利計算機 -->
        <div id="compoundCalculator" class="calculator-content hidden">
            <!-- 複利計算機說明區塊 -->
            <div class="bg-white rounded-lg shadow-md p-4 mb-8">
                <div id="compoundExplanationHeader" class="flex justify-between items-center cursor-pointer" onclick="toggleExplanation('compoundExplanation')">
                    <h2 class="text-xl font-semibold text-indigo-600">複利計算機說明</h2>
                    <button id="compoundExplanationToggle" class="text-gray-500 hover:text-indigo-600">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                        </svg>
                    </button>
                </div>
                
                <div id="compoundExplanationContent" class="mt-3 hidden">
                    <h3 class="font-medium text-indigo-600 mt-2 mb-1">使用方法</h3>
                    <p class="text-gray-700 mb-2">複利計算機為計算存款、股票、虛擬貨幣的投資收益工具，投資時請善用複利計算機預測未來收益。</p>
                    <ul class="list-disc list-inside text-gray-700 mb-3 space-y-1">
                        <li><span class="font-medium">初期本金</span>：輸入開始金額。</li>
                        <li><span class="font-medium">計息期數</span>：輸入投資期數，複利將按照輸入期數重複計算。</li>
                        <li><span class="font-medium">收益率</span>：輸入預期的複利收益率。</li>
                        <li><span class="font-medium">計算</span>：輸出以複利計算的結果。</li>
                    </ul>
                    
                    <h3 class="font-medium text-indigo-600 mt-4 mb-1">複利的意義</h3>
                    <p class="text-gray-700 mb-2">複利為計算投資資產的利息時，合計本金與前面的利息，計算下一次利息的方式。不同於每次產生相同利息的單利投資，複利投資的利息會越來越多。因此，複利投資的資產會隨時間呈等比級數成長。</p>
                    
                    <div class="overflow-x-auto my-3">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">#</th>
                                    <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">資本</th>
                                    <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">收益</th>
                                    <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">收益率</th>
                                    <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">總額</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                <tr>
                                    <td class="px-4 py-2 whitespace-nowrap">1</td>
                                    <td class="px-4 py-2 whitespace-nowrap">10,000</td>
                                    <td class="px-4 py-2 whitespace-nowrap">1,000</td>
                                    <td class="px-4 py-2 whitespace-nowrap">10%</td>
                                    <td class="px-4 py-2 whitespace-nowrap">11,000</td>
                                </tr>
                                <tr>
                                    <td class="px-4 py-2 whitespace-nowrap">2</td>
                                    <td class="px-4 py-2 whitespace-nowrap">11,000</td>
                                    <td class="px-4 py-2 whitespace-nowrap">1,100</td>
                                    <td class="px-4 py-2 whitespace-nowrap">21%</td>
                                    <td class="px-4 py-2 whitespace-nowrap">12,100</td>
                                </tr>
                                <tr>
                                    <td class="px-4 py-2 whitespace-nowrap">3</td>
                                    <td class="px-4 py-2 whitespace-nowrap">12,100</td>
                                    <td class="px-4 py-2 whitespace-nowrap">1,210</td>
                                    <td class="px-4 py-2 whitespace-nowrap">33.1%</td>
                                    <td class="px-4 py-2 whitespace-nowrap">13,310</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <p class="text-gray-700 mb-3">假設初期資本為10,000，每年增加10%。雖然第一年的利息增加10%，但第二年增加11%。最後第三年的總金額為本金加上33.1%的13,310。此情況的金額比單利投資高3.1p.p.。</p>
                    
                    <h3 class="font-medium text-indigo-600 mt-4 mb-1">複利的公式</h3>
                    <p class="text-gray-700 mb-2">複利投資時，可利用以下方法計算資產的未來價值。</p>
                    <div class="bg-gray-100 p-3 my-2 rounded text-center">
                        <p class="font-medium">F = P(1 + r)^n</p>
                    </div>
                    <ul class="list-disc list-inside text-gray-700 mb-3 space-y-1">
                        <li><span class="font-medium">F</span>：未來價值</li>
                        <li><span class="font-medium">P</span>：目前價值</li>
                        <li><span class="font-medium">r</span>：利率</li>
                        <li><span class="font-medium">n</span>：期數</li>
                    </ul>
                    <p class="text-gray-700 mb-3">此計算機使用的複利算式套用此公式。</p>
                    
                    <h3 class="font-medium text-indigo-600 mt-4 mb-1">72法則</h3>
                    <p class="text-gray-700 mb-2">72法則是透過心算得知資產變成2倍所需期間的方法。</p>
                    <div class="bg-gray-100 p-3 my-2 rounded text-center">
                        <p class="font-medium">資產翻倍所需年數 ≈ 72 / 年報酬率(%)</p>
                    </div>
                    <p class="text-gray-700 mb-3">計算方法單純僅以72除以複利利率。假設利率為5%，則資產變成2倍所需期間為72/5 = 14.4年，非常接近實際期間14.207年。在沒有計算機的情況下，此為相當有用的方法。就數學上而言，使用69.3比72更加精確，因此也會使用69法則或70法則。不過72能除以更多非負整數，故通常使用72法則。</p>
                </div>
            </div>
            
            <div class="grid md:grid-cols-2 gap-8">
                <!-- 複利計算機輸入區塊 -->
                <div class="bg-white rounded-lg shadow-md p-6">
                    <h2 class="text-xl font-semibold mb-6 text-indigo-600 border-b pb-2">投資參數設定</h2>
                    
                    <div class="space-y-4">
                        <div>
                            <label for="principal" class="block text-sm font-medium text-gray-700 mb-1">初期本金 (元)</label>
                            <input type="number" id="principal" min="0" value="10000" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500">
                        </div>
                        
                        <div>
                            <label for="periods" class="block text-sm font-medium text-gray-700 mb-1">計息期數 (年)</label>
                            <input type="number" id="periods" min="1" max="100" value="10" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500">
                        </div>
                        
                        <div>
                            <label for="rate" class="block text-sm font-medium text-gray-700 mb-1">年收益率 (%)</label>
                            <input type="number" id="rate" min="0" max="100" step="0.1" value="7" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500">
                        </div>
                        
                        <div>
                            <label for="contribution" class="block text-sm font-medium text-gray-700 mb-1">定期追加金額 (元/年)</label>
                            <input type="number" id="contribution" min="0" value="0" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500">
                        </div>
                        
                        <div class="pt-4">
                            <button onclick="calculateCompound()" class="w-full bg-indigo-600 text-white py-2 px-4 rounded-md hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">
                                計算
                            </button>
                        </div>
                    </div>
                </div>
                
                <!-- 複利計算結果顯示區塊 -->
                <div class="bg-white rounded-lg shadow-md p-6">
                    <h2 class="text-xl font-semibold mb-6 text-indigo-600 border-b pb-2">複利計算結果</h2>
                    
                    <div class="space-y-6">
                        <div class="p-4 bg-indigo-50 rounded-lg">
                            <h3 class="font-medium text-indigo-700 mb-2">最終金額</h3>
                            <p class="text-3xl font-bold text-indigo-600" id="finalAmount">19,671元</p>
                            <p class="text-sm text-gray-600 mt-1">
                                初始投資 <span id="resultPrincipal">10,000</span> 元，收益 <span id="resultInterest">9,671</span> 元
                            </p>
                        </div>
                        
                        <div>
                            <h3 class="font-medium text-gray-700 mb-3">72法則</h3>
                            <p class="text-gray-600">以目前收益率 <span id="ruleOf72Rate">7</span>%，資金將約在 <span id="doubleTime" class="font-semibold">10.3</span> 年後翻倍</p>
                        </div>
                        
                        <div>
                            <h3 class="font-medium text-gray-700 mb-3">資產成長曲線</h3>
                            <canvas id="compoundChart" width="400" height="200"></canvas>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- 詳細複利成長表格 -->
            <div class="mt-12 bg-white rounded-lg shadow-md p-6 overflow-auto">
                <h2 class="text-xl font-semibold mb-6 text-indigo-600 border-b pb-2">逐年複利成長詳情</h2>
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">年度</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">期初金額</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">當年追加</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">當年收益</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">期末金額</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">累計收益率</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200" id="compoundGrowthTable">
                        <!-- 這部分將由JavaScript動態生成 -->
                    </tbody>
                </table>
            </div>
        </div>
        
        <footer class="mt-12 text-center text-sm text-gray-500">
            <p>財務計算工具 &copy; 2023 - 僅供參考，不構成投資建議</p>
            <p class="mt-2">實際情況可能因個人投資策略與經濟環境而異</p>
        </footer>
    </div>

    <script>
        // 初始化圖表
        let growthChart, compoundChart;
        
        // 頁面載入時執行
        window.addEventListener('load', function() {
            // 初始化FIRE計算機圖表
            const firectx = document.getElementById('growthChart').getContext('2d');
            growthChart = new Chart(firectx, {
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
        });
    </script>
</body>
</html>
