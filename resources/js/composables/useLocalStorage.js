import { onMounted, onScopeDispose, ref, watch } from "vue";

export default function (initialValue, key){
  const val = ref(initialValue);

  onMounted(() => {

    const storageVal = window.localStorage.getItem(key);
    
    if (storageVal) {
        val.value = JSON.parse(storageVal);
    }
    function handleStorageEvent (event) {
        if(event.key == key){
          val.value = JSON.parse(event.newValue || 'null');
        }
    }

    window.addEventListener('storage', handleStorageEvent);

    onScopeDispose(() => window.removeEventListener('storage', handleStorageEvent));

    watch(val, val => {
      window.localStorage.setItem(key, JSON.stringify(val));
    }, {deep: true});

  })

  return val;
} 