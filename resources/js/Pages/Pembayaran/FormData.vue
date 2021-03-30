<template>
	<form @submit.prevent="submit()">
		<div class="flex items-center justify-between mb-5">
			<h1 v-if="edit" class="text-lg font-bold">
				<span>Edit Data Spp</span>
			</h1>
			<h1 v-else class="text-lg font-bold">
				<span>Entri Pembayaran</span>
			</h1>
			<form-button
				class="ml-4 bg-indigo-400"
				:class="{ 'opacity-25': form.processing }"
				:disabled="form.processing"
			>
				<fade>
					<icon
						v-if="!form.processing"
						name="save-icon"
						class="mr-3"
					></icon>
					<spin-animation
						v-else-if="form.processing"
						:animation-showed="form.processing"
					></spin-animation>
				</fade>
				<span>Simpan</span>
			</form-button>
		</div>
		<div class="grid grid-cols-2 md:gap-5 gap-3">
			<div class="mt-4">
				<input-label for="bulan_bayar" value="Bulan Bayar" />
				<select
					required
					v-model="form.bulan_bayar"
					:class="{
						'border-red-500': form.errors.bulan_bayar,
					}"
					class="w-full block mt-1 border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm"
				>
					<option disabled hidden :value="null">Pilih Bulan</option>
					<option
						v-for="(m, index) in months"
						:key="index"
						:value="m"
					>
						{{ m }}
					</option>
				</select>
				<form-error
					class="mt-3"
					:message="form.errors.bulan_bayar"
				></form-error>
			</div>

			<div class="mt-4">
				<input-label for="tahun_bayar" value="Tahun Bayar" />
				<form-input
					id="tahun_bayar"
					type="number"
					class="mt-1 block w-full"
					v-model="form.tahun_bayar"
					required
					autocomplete="tahun_bayar"
				/>
				<form-error
					class="mt-3"
					:message="form.errors.tahun_bayar"
				></form-error>
			</div>

			<div class="mt-4">
				<input-label for="spp" value="Spp" />
				<select
					required
					v-model="form.id_spp"
					:disabled="data.spp"
					:class="[
						{
							'border-red-500': form.errors.id_spp,
						},
						{ 'text-gray-400': data.spp },
					]"
					class="w-full block mt-1 border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm"
				>
					<option selected disabled hidden :value="null">
						Pilih Spp
					</option>
					<option
						v-for="eachSpp in spp"
						:key="eachSpp.id"
						:value="eachSpp.id"
					>
						Tahun {{ eachSpp.tahun }} - Nominal
						{{ eachSpp.nominal }}
					</option>
				</select>
				<p v-if="spp.length == 0" class="text-xs text-red-600 mt-5">
					*Pastikan terdapat data spp yang telah diinput
				</p>
				<p v-if="!data.spp" class="text-xs text-red-600 mt-5">
					*Siswa tidak memiliki spp yang ditetapkan, silahkan ubah
					data siswa terlebih dahulu
					<inertia-link
						:href="route('siswa.edit', data.nisn)"
						class="border-b border-indigo-500 text-indigo-500"
						>disini</inertia-link
					>
				</p>
				<form-error
					class="mt-3"
					:message="form.errors.id_spp"
				></form-error>
			</div>

			<div class="mt-4">
				<input-label for="jumlah_bayar" value="Jumlah Bayar" />
				<form-input
					id="jumlah_bayar"
					type="number"
					class="mt-1 block w-full"
					:class="{ 'text-gray-400': automaticFill }"
					v-model="form.jumlah_bayar"
					:value="automaticFill ? data.spp.nominal : null"
					required
					autocomplete="jumlah_bayar"
					:disabled="automaticFill"
				/>
				<form-error
					class="mt-3"
					:message="form.errors.jumlah_bayar"
				></form-error>
				<label class="flex items-center mt-3">
					<form-checkbox
						name="remember"
						v-model:checked="automaticFill"
					/>
					<span class="ml-2 text-sm text-gray-600">Otomatis Isi</span>
				</label>
			</div>
		</div>
	</form>
</template>

<script>
import FormButton from "@/Components/Button";
import FormInput from "@/Components/Input";
import FormError from "@/Components/InputError";
import InputLabel from "@/Components/Label";
import Icon from "@/Components/Icon";
import SpinAnimation from "@/Components/SpinAnimation.vue";
import Fade from "@/Components/Fade";
import months from "../../Helper/month";
import FormCheckbox from "@/Components/Checkbox";

export default {
	components: {
		FormInput,
		InputLabel,
		FormButton,
		FormError,
		Icon,
		SpinAnimation,
		Fade,
		FormCheckbox,
	},

	props: {
		edit: {
			default: false,
		},
		data: {
			default: null,
		},
		spp: {
			default: null,
		},
	},

	data() {
		return {
			form: this.$inertia.form({
				nisn: this.data ? this.data.nisn : null,
				id_petugas: this.$page.props.auth.user
					? this.$page.props.auth.user.id
					: null,
				bulan_bayar: null,
				tahun_bayar: null,
				id_spp: this.data.spp ? this.data.spp.id : null,
				jumlah_bayar: null,
			}),

			automaticFill: true,

			months: months,
		};
	},

	watch: {
		automaticFill(val) {
			if (val) {
				this.form.jumlah_bayar = this.data.spp.nominal;
			} else {
				this.form.jumlah_bayar = null;
			}
		},
	},

	methods: {
		submit() {
			if (this.edit && this.data) {
				//console.log(this.data);
				this.form.put(this.route("pemabayaran.update", this.data.id));
			} else {
				this.form.post(this.route("pembayaran.store"), {
					preserveScroll: true,
				});
			}
		},
	},
};
</script>