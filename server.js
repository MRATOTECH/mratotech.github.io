const express = require('express');
const path = require('path');

const app = express();
const PORT = process.env.PORT || 3000;

// Enable static asset fallback for nested directories (e.g. /blog/assets, /portfolio/assets)
app.use('/blog/assets', express.static(path.join(__dirname, 'assets')));
app.use('/portfolio/assets', express.static(path.join(__dirname, 'assets')));

// Serve all static files from root directory with html extension fallback
app.use(express.static(__dirname, {
  extensions: ['html', 'htm']
}));

// Route root to index.html explicitly
app.get('/', (req, res) => {
  res.sendFile(path.join(__dirname, 'index.html'));
});

// Custom 404 handler
app.use((req, res) => {
  res.status(404).sendFile(path.join(__dirname, '404.html'));
});

app.listen(PORT, '0.0.0.0', () => {
  console.log(`Server listening on port ${PORT}`);
});
