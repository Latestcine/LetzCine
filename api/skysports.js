export default async function handler(req, res) {
  try {
    const blogUrl = 'https://cmvlive.blogspot.com/2025/06/live-3.html?m=1';
    const response = await fetch(blogUrl);
    const html = await response.text();

    const m3u8Match = html.match(/https:\/\/[^"]+\.m3u8[^"']*/);

    if (m3u8Match && m3u8Match[0]) {
      const streamUrl = m3u8Match[0];
      res.setHeader("Access-Control-Allow-Origin", "*");
      res.writeHead(302, { Location: streamUrl });
      res.end();
    } else {
      res.status(404).send("Stream URL not found.");
    }
  } catch (error) {
    console.error("API error:", error);
    res.status(500).send("Error fetching stream.");
  }
} 
