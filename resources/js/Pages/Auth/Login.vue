<template>
	<form @submit.prevent="submit">
		<div>
			<breeze-label for="username" value="Username" />
			<breeze-input
				id="username"
				type="text"
				class="mt-1 block w-full"
				v-model="form.username"
				required
				autofocus
				autocomplete="username"
				placeholder="account@spp"
			/>
			<form-error
				class="mt-3"
				:message="form.errors.username"
			></form-error>
		</div>

		<div class="mt-4">
			<breeze-label for="password" value="Password" />
			<breeze-input
				id="password"
				type="password"
				class="mt-1 block w-full"
				v-model="form.password"
				required
				autocomplete="current-password"
			/>
			<form-error
				class="mt-3"
				:message="form.errors.password"
			></form-error>
		</div>

		<div class="block mt-4">
			<label class="flex items-center">
				<breeze-checkbox
					name="remember"
					v-model:checked="form.remember"
				/>
				<span class="ml-2 text-sm text-gray-600">Ingat saya</span>
			</label>
		</div>

		<div class="mt-4">
			<breeze-button
				class="bg-indigo-400 py-3 text-center justify-center hover:bg-indigo-500 block w-full"
				:class="{ 'opacity-25': form.processing }"
				:disabled="form.processing"
			>
				<icon name="login-icon"></icon>
				<p class="ml-2">Masuk</p>
			</breeze-button>
		</div>
	</form>
</template>

<script>
import BreezeButton from "@/Components/Button";
import BreezeGuestLayout from "@/Layouts/Guest";
import BreezeInput from "@/Components/Input";
import BreezeCheckbox from "@/Components/Checkbox";
import BreezeLabel from "@/Components/Label";
import FormError from "@/Components/InputError";
import Icon from "@/Components/Icon";

export default {
	layout: BreezeGuestLayout,

	components: {
		BreezeButton,
		BreezeInput,
		BreezeCheckbox,
		BreezeLabel,
		FormError,
		Icon,
	},

	props: {
		canResetPassword: Boolean,
		status: String,
	},

	data() {
		return {
			form: this.$inertia.form({
				username: "",
				password: "",
				remember: false,
			}),
		};
	},

	methods: {
		submit() {
			this.form
				.transform((data) => ({
					...data,
					remember: this.form.remember ? "on" : "",
				}))
				.post(this.route("login"), {
					onFinish: () => this.form.reset("password"),
				});
		},
	},
};
</script>
