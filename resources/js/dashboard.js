import Chart from 'chart.js/auto';
console.log('DASHBOARD JS LOADED');
document.addEventListener('DOMContentLoaded', () => {
    const canvas = document.getElementById('revenueChart');
    if (!canvas) {
        return;
    }
    const revenueData = JSON.parse(canvas.dataset.revenue);
    const monthNames = ['Янв','Фев','Мар','Апр','Май','Июн','Июл','Авг','Сен','Окт','Ноя','Дек',];
    const labels = revenueData.map(item => {
        return monthNames[Number(item.month) - 1];
    });

    const values = revenueData.map(item => {
        return Number(item.total);
    });

    new Chart(canvas, {
        type: 'line',
        data: {
            labels: labels,
            datasets: [
                {
                    label: 'Выручка',
                    data: values,
                    tension: 0.4,
                    fill: true,
                    borderWidth: 2,
                    pointRadius: 4,
                    pointHoverRadius: 6,
                },
            ],
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            interaction: {
                intersect: false,
                mode: 'index',
            },
            plugins: {
                legend: {
                    display: false,
                },
                tooltip: {
                    callbacks: {
                        label(context) {
                            return ' €' + Number(context.raw)
                                .toLocaleString('ru-RU', {
                                    minimumFractionDigits: 2,
                                    maximumFractionDigits: 2,
                                });
                        },
                    },
                },
            },
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: {
                        callback(value) {
                            return '€' + Number(value)
                                .toLocaleString('ru-RU');
                        },
                    },
                },
            },
        },
    });
});
