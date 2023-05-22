<!--
Say Hello World with Vue!
-->

<script>

export default {
  data() {
    return {
      message: 'Hello World!'
    }
  },
  mounted() {
	window.Echo.channel('channel')
		.listen('Hello', (e) => {
			console.log(e)
		})
  }
}
</script>

<template>
  <h1>{{ message }}</h1>
</template>