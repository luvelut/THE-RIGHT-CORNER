<?php


namespace App\Security\Voters;


use App\Entity\User;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Authorization\Voter\Voter;
use Symfony\Component\Security\Core\Exception\LogicException;

class UserVoter extends Voter
{
    const EDIT = 'edit';
    const DELETE_ADMIN = 'delete_admin';
    const EDIT_ADMIN = 'edit_admin';

    protected function supports(string $attribute, $subject) : bool
    {
        // if the attribute isn't one we support, return false
        if (!in_array($attribute, [self::EDIT,self::DELETE_ADMIN, self::EDIT_ADMIN])) {
            return false;
        }

        // only vote on Exercise objects
        if (!$subject instanceof User) {
            return false;
        }

        return true;
    }

    protected function voteOnAttribute(string $attribute, $subject, TokenInterface $token): bool
    {
        $user=$token->getUser();
        if (null===$user) {
            return false;
        }

        if (!$user instanceof User) {
            // the user must be logged in; if not, deny access
            return false;
        }

        // you know $subject is a Advert object, thanks to `supports()`
        /** @var User $member */
        $member = $subject;

        switch ($attribute) {
            case self::EDIT:
                return $this->canEdit($member, $user);
            case self::DELETE_ADMIN:
                return $this->canDeleteAdmin($user);
            case self::EDIT_ADMIN:
                return $this->canEditAdmin($user);
        }

        throw new LogicException('This code should not be reached!');
    }


    private function canEdit(User $member, User $user): bool
    {
        return $user === $member;
    }

    private function canDeleteAdmin(User $user): bool
    {
        // if they can edit, they can view
        if ($this->canEditAdmin($user)) {
            return true;
        }

        return false;
    }

    private function canEditAdmin(User $user): bool
    {
        return $user->getIsAdmin();
    }
}