<x-app-layout>
  <div class="container">
    <div id="vehicleUsageByMonth" class="tw-mb-10">
      <h1 class="tw-font-semibold tw-text-lg lg:tw-text-2xl">Pemakaian Kendaraan selama 6 Bulan Terakhir</h1>
      <div style="width: 100%; margin: auto;">
          <canvas id="vehicleUsageMonth"></canvas>
      </div>
    </div>
    <div id="topKVehicle" class="tw-mb-10">
      <h1 class="tw-font-semibold tw-text-lg lg:tw-text-2xl">Top 10 Kendaraan yang Sering Digunakan</h1>
      <div style="width: 100%; margin: auto;">
          <canvas id="topKVehicleUsage"></canvas>
      </div>
    </div>
    <div id="typeVehicle">
      <h1 class="tw-font-semibold tw-text-lg lg:tw-text-2xl">Penggunaan Berdasarkan Tipe Kendaraan</h1>
      <div style="width: 100%; margin: auto;">
          <canvas id="typeVehicleUsage"></canvas>
      </div>
    </div>
    <script>
      const usageMonthCtx = document.getElementById('vehicleUsageMonth').getContext('2d');
      const topKCtx = document.getElementById('topKVehicleUsage').getContext('2d');
      const usageTypeCtx = document.getElementById('typeVehicleUsage').getContext('2d');

      new Chart(usageMonthCtx, {
          type: 'line',
          data: {
              labels: @json($data['usageDataMonth']['labels']),
              datasets: [{
                  label: 'Jumlah Kendaraan',
                  data: @json($data['usageDataMonth']['data']),
                  backgroundColor: 'rgba(75, 192, 192, 0.2)',
                  borderColor: 'rgba(75, 192, 192, 1)',
                  borderWidth: 1
              }]
          },
          options: {
              scales: {
                  y: {
                      beginAtZero: true
                  }
              }
          }
      });

      new Chart(topKCtx, {
          type: 'bar',
          data: {
              labels: @json($data['top10Usage']['labels']),
              datasets: [{
                  label: 'Jumlah Penggunaan',
                  data: @json($data['top10Usage']['data']),
                  backgroundColor: 'rgba(75, 192, 192, 0.2)',
                  borderColor: 'rgba(75, 192, 192, 1)',
                  borderWidth: 1
              }]
          },
          options: {
              scales: {
                  y: {
                      beginAtZero: true
                  }
              }
          }
      });

      new Chart(usageTypeCtx, {
          type: 'bar',
          data: {
              labels: @json($data['usageType']['labels']),
              datasets: [{
                  label: 'Jumlah Penggunaan',
                  data: @json($data['usageType']['data']),
                  backgroundColor: 'rgba(75, 192, 192, 0.2)',
                  borderColor: 'rgba(75, 192, 192, 1)',
                  borderWidth: 1
              }]
          },
          options: {
              scales: {
                  y: {
                      beginAtZero: true
                  }
              }
          }
      });
    </script>
  </div>
</x-app-layout>
