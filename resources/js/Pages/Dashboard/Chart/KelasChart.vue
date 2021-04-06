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
			},
			labels: [],
			stroke: {
				width: 1,
				colors: undefined,
			},
			fill: {
				opacity: 1,
			},
			plotOptions: {
				polarArea: {
					rings: {
						strokeWidth: 0,
					},
					spokes: {
						strokeWidth: 0,
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