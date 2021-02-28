<template>
  <main class="stack-large">
    <div class="home-left">
      <p>Modi eveniet debitis, architecto a deleniti explicabo. Eligendi ipsam harum quis id, in eveniet, modi, aperiam necessitatibus itaque beatae, soluta dolore sequi ad aliquid molestiae molestias totam esse quasi odio.</p>
      <p>Sapiente quaerat incidunt nesciunt, nemo, beatae deleniti. Eius accusamus fuga excepturi asperiores magnam consequatur suscipit vitae nemo libero quisquam iste dolore ducimus eum quod, unde laboriosam sunt harum quos quo.</p>
    </div>
    <div class="home-right">
      <h2>Waarom kiest u voor Valuto?</h2>
      <p>Culpa laboriosam deleniti, beatae tenetur aliquam asperiores reprehenderit, quisquam. Quod ab molestiae expedita iusto natus. Iusto dignissimos error saepe sapiente consequatur, labore placeat, quam magnam ipsam libero autem, vero vel.</p>
      <p>Dolorum, quasi, adipisci nesciunt nisi id, iure repellendus nobis nihil odio quam porro blanditiis ad, dolorem suscipit voluptatem numquam praesentium eum est! Ratione quasi quo eius, illum repellendus, asperiores nemo?</p>
      <router-link class="button" to="register">Maak nu een account aan</router-link>
    </div>
  </main>
</template>

<script>
  export default {
    name: 'Home',
  }
</script>

<style lang="scss" scoped>
  .home-left {
    width: clamp(min(24rem, 100%), 60%, 60%);
  }
  .home-right {
    float: right;
    width: clamp(min(24rem, 100%), 60%, 60%);
  }
  a.button {
    margin-top: 1rem;
  }
</style>
