<template>
	<base-chart :title="title">
		<apexchart
			height="400"
			type="polarArea"
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

	data: () => ({
		series: [],
		options: {
			chart: {
				type: "polarArea",
				foreColor: "#6E8192",
			},
			labels: [],
			stroke: {
				width: 1,
				colors: undefined,
			},
			fill: {
				opacity: 0.98,
			},
			plotOptions: {
				polarArea: {
					rings: {
						strokeWidth: 0,
					},
					spokes: {
						strokeWidth: 1,
					},
				},
			},
			legend: {
				show: true,
				position: "bottom",
			},
			yaxis: {
				show: false,
			},
			theme: {
				palette: "palette1",
			},
		},
	}),

	beforeMount() {
		this.data.forEach((data) => {
			this.series.push(data.siswa_count);
			this.options.labels.push(data.nama_kelas);
		});
	},
};
</script>