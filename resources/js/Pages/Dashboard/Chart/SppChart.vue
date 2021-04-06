<template>
	<base-chart :title="title">
		<apexchart
			height="300"
			type="area"
			:options="options"
			:series="series"
		></apexchart>
	</base-chart>
</template>

<script>
import BaseChart from "./BaseChart";
export default {
	components: {
		BaseChart,
	},

	props: ["data", "title"],

	computed: {},

	data: () => ({
		options: {
			chart: {
				height: 350,
				type: "area",
			},
			colors: ["#7176F2"],
			stroke: {
				width: 3,
			},
			grid: {
				borderColor: "#555",
				clipMarkers: false,
				yaxis: {
					lines: {
						show: false,
					},
				},
			},
			tooltip: {
				theme: "light",
			},
			fill: {
				gradient: {
					enabled: true,
					opacityFrom: 0.97,
					opacityTo: 0,
				},
			},
			markers: {
				size: 5,
				colors: ["#fff"],
				strokeColor: "#7176F2",
				strokeWidth: 3,
			},
			dataLabels: {
				enabled: false,
			},
			stroke: {
				curve: "smooth",
			},
			xaxis: {
				categories: [],
			},
		},

		series: [
			{
				name: "Nominal",
				data: [],
			},
		],
	}),

	beforeMount() {
		this.data.forEach((data) => {
			this.options.xaxis.categories.push(data.tahun);
			this.series[0].data.push(data.nominal);
		});
	},
};
</script>