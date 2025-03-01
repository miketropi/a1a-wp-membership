;(() => {
  'use strict'

const { ajax_url, nonce } = A1AM_PHP_DATA;
const searchInput = document.querySelector('form.a1am-search-form input[name=q]')
let searchTimeout

if (searchInput) {
  searchInput.addEventListener('input', function(e) {
    // Clear previous timeout
    if (searchTimeout) {
      clearTimeout(searchTimeout)
    }

    // Set new timeout to avoid multiple requests
    searchTimeout = setTimeout(() => {
      const searchQuery = e.target.value.trim()
      
      // Make AJAX request
      fetch(ajax_url, {
        method: 'POST',
        headers: {
          'Content-Type': 'application/x-www-form-urlencoded',
        },
        body: new URLSearchParams({
          action: 'a1am_search_course_ajax',
          nonce: nonce,
          q: searchQuery
        })
      })
      .then(response => response.json())
      .then(data => {
        // Handle the response data here
        if (data.success) {
          // Update results on the page
          const resultsContainer = document.querySelector('.a1am-search-lightbox__results')
          if (resultsContainer) {
            resultsContainer.innerHTML = data.content;
          }
        }
      })
      .catch(error => {
        console.error('Search error:', error)
      })
    }, 500) // 500ms delay after typing stops
  })
}

})(window)