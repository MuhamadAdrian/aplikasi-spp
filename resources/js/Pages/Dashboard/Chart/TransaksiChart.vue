<template>
	<base-chart :title="title">
		<apexchart
			height="300"
			type="line"
			:options="options"
			:series="series"
		></apexchart>
	</base-chart>
</template>

<script>
import BaseChart from "./BaseChart";
import month from "@/Helper/month.js";
export default {
	components: {
		BaseChart,
	},

	props: ["data", "title"],

	data: () => ({
		months: month,
		uang_masuk: [],
		banyak_transaksi: [],
		series: [
			{
				name: "Jumlah Pemasukan",
				type: "column",

				data: [],
			},
			{
				name: "Banyak Transaksi",
				type: "line",
				data: [],
			},
		],
		options: {
			chart: {
				height: 350,
				type: "line",
			},

			colors: ["#F44336", "#9C27B0"],
			stroke: {
				width: [0, 4],

				curve: "smooth",
			},
			fill: {
				gradient: {
					enabled: true,
					opacityFrom: 0.97,
					opacityTo: 0,
				},
			},

			title: {
				text: "Transaksi Track",
			},
			dataLabels: {
				enabled: true,
				enabledOnSeries: [1],
			},
			labels: month,
			yaxis: [
				{
					title: {
						text: "Pemasukan",
					},
				},
				{
					opposite: true,
					title: {
						text: "Banyak Transaksi",
					},
				},
			],
		},
	}),

	beforeMount() {
		this.series[0].data = this.data.map(($d) => {
			return $d.uang_masuk;
		});
		this.series[1].data = this.data.map(($d) => {
			return $d.banyak_transaksi;
		});
	},
};
</script>