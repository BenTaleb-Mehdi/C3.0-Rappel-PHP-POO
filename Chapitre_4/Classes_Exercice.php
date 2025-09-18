<?php

class User {
    public function __construct(
        public int $id,
        public string $name,
        public string $email,
        public ?string $bio = null,
        public int $articlesCount = 0,
    ) {}

    public function initials(): string {
        $parts = preg_split('/\s+/', trim($this->name));
        $letters = array_map(fn($p) => mb_strtoupper(mb_substr($p, 0, 1)), $parts);
        return implode('', $letters);
    }

    public function toArray(): array {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'email' => $this->email,
            'bio' => $this->bio,
            'articlesCount' => $this->articlesCount,
        ];
    }
}

class UserFactory {

    public static function fromArray(array $a): User {
        $id = max(1, $a['id'] ?? 0);
        $name = trim((string)($a['name'] ?? 'Inconnu'));
        $email = trim((string)($a['email'] ?? ''));

        if ($email === '') {
            throw new Exception("Email invalid, try again");
        }

        $bio = trim((string)($a['bio'] ?? '')) ?: null;
        $articlesCount = (int)($a['articlesCount'] ?? 0);

        return new User($id, $name, $email, $bio, $articlesCount);
    }
}

// Example data
$data = [
    'id' => 1,
    'name' => 'Mehdi Bentaleb',
    'email' => 'mehdibentaleb548@gmail.com',
    'bio' => 'Fullstack developer',
    'articlesCount' => 5
];

// Create user
$user = UserFactory::fromArray($data);

print_r($user->toArray());
echo "Initials: " . $user->initials();
